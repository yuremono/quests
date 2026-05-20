<?php
/**
 * Hidden placeholder sections (Next.tsx hidden Form / ImgText).
 *
 * @package Theme
 */

declare(strict_types=1);
?>
<div class="ImgText grid-cols-1 items-center gap-8 md:grid-cols-2 ImgText hidden">
	<div>
		<div class="h-full">
			<p>ここにテキストを入力します</p>
		</div>
	</div>
</div>

<section class="Form Form hidden" style="--base: 1200px;">
	<div class="mb-8">
		<h2>お問い合わせ</h2>
		<p>以下のフォームよりおください。</p>
	</div>
	<form class="mx-auto max-w-2xl">
		<div class="mb-4">
			<label for="nc-name" class="mb-2 block font-medium">お名前</label>
			<input type="text" id="nc-name" class="w-full rounded border border-[var(--border)] bg-[var(--background)] p-2 text-[var(--foreground)]" required name="name">
		</div>
		<div class="mb-4">
			<label for="nc-email" class="mb-2 block font-medium">メールアドレス</label>
			<input type="email" id="nc-email" class="w-full rounded border border-[var(--border)] bg-[var(--background)] p-2 text-[var(--foreground)]" required name="email">
		</div>
		<div class="mb-4">
			<label for="nc-message" class="mb-2 block font-medium">メッセージ</label>
			<textarea id="nc-message" name="message" rows="4" class="w-full rounded border border-[var(--border)] bg-[var(--background)] p-2 text-[var(--foreground)]" required></textarea>
		</div>
		<div class="mb-4">
			<label class="flex items-center gap-2">
				<input type="checkbox" class="mr-0" required name="privacy">
				<span>プライバシーポリシーに同意する</span>
			</label>
		</div>
		<button type="submit" class="rounded bg-slate-700 px-4 py-2 font-medium text-white">送信</button>
	</form>
</section>
