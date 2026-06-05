#!/usr/bin/env bash
# Run bootstrap-quests-site.php with a PHP binary that works in Local WP environments.
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PHP_BIN="${QUESTS_LOCAL_PHP:-${DEPLOY_PHP:-}}"
PHP_INI="${QUESTS_LOCAL_PHP_INI:-}"

discover_local_php() {
	shopt -s nullglob
	local candidate
	for candidate in \
		"${HOME}/Library/Application Support/Local/lightning-services"/php-*/bin/darwin-arm64/bin/php \
		"${HOME}/Library/Application Support/Local/lightning-services"/php-*/bin/darwin-x86_64/bin/php \
		"/Applications/Local.app/Contents/Resources/extraResources/lightning-services"/php-*/bin/darwin-arm64/bin/php \
		"/Applications/Local.app/Contents/Resources/extraResources/lightning-services"/php-*/bin/darwin-x86_64/bin/php; do
		if [[ -x "$candidate" ]]; then
			printf '%s\n' "$candidate"
			return 0
		fi
	done
	return 1
}

discover_local_php_ini() {
	local fpm_conf
	local candidate

	fpm_conf="$(
		ps -axo command |
			awk '/Local\/run\/.*\/conf\/php\/php-fpm\.conf/ && !/awk/ {
				match($0, /\/Users\/[^)]*Local\/run\/[^)]*\/conf\/php\/php-fpm\.conf/)
				if (RSTART > 0) {
					print substr($0, RSTART, RLENGTH)
					exit
				}
			}'
	)"

	if [[ -n "$fpm_conf" ]]; then
		candidate="${fpm_conf%/php-fpm.conf}/php.ini"
		if [[ -r "$candidate" ]]; then
			printf '%s\n' "$candidate"
			return 0
		fi
	fi

	shopt -s nullglob
	for candidate in "${HOME}/Library/Application Support/Local/run"/*/conf/php/php.ini; do
		if [[ -r "$candidate" ]]; then
			printf '%s\n' "$candidate"
			return 0
		fi
	done
	return 1
}

if [[ -z "$PHP_BIN" ]]; then
	if PHP_BIN="$(discover_local_php)"; then
		:
	elif command -v php >/dev/null 2>&1; then
		PHP_BIN="$(command -v php)"
	else
		echo "PHP が見つかりません。QUESTS_LOCAL_PHP に PHP のフルパスを指定してください。" >&2
		exit 127
	fi
fi

PHP_ARGS=()
if [[ -z "$PHP_INI" ]]; then
	if PHP_INI="$(discover_local_php_ini)"; then
		:
	else
		PHP_INI=""
	fi
fi

if [[ -n "$PHP_INI" ]]; then
	PHP_ARGS=(-c "$PHP_INI")
fi

set +e
output="$("$PHP_BIN" "${PHP_ARGS[@]}" "${SCRIPT_DIR}/bootstrap-quests-site.php" "$@" 2>&1)"
status=$?
set -e

printf '%s\n' "$output"

if [[ "$status" -ne 0 ]]; then
	exit "$status"
fi

if printf '%s' "$output" | grep -qE 'wp-die-message|データベース接続確立エラー|Error establishing a database connection'; then
	echo "WordPress が DB に接続できませんでした。Local で quests サイトを Start してください。" >&2
	exit 1
fi
