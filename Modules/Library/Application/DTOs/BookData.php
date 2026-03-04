<?php

namespace Modules\Library\Application\DTOs;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class BookData extends Data
{
	public function __construct(
		public string $title,
		public string $author,
		public ?string $isbn = null,
		public ?string $published_at = null,
		public ?int $pages = null,
		public ?string $summary = null,
		public ?string $language = null,
		public ?string $audio_url = null,
	) {
	}

	public static function rules(): array
	{
		return [
			'title' => ['required', 'string', 'max:255'],
			'author' => ['required', 'string', 'max:255'],
			'isbn' => ['nullable', 'string', 'max:32'],
			'published_at' => ['nullable', 'date'],
			'pages' => ['nullable', 'integer', 'min:1'],
			'summary' => ['nullable', 'string'],
			'language' => ['nullable', 'string', 'max:32'],
			'audio_url' => ['nullable', 'url'],
		];
	}

	public static function fromRequest(Request $request): self
	{
		$validated = $request->validate(self::rules());

		return self::from($validated);
	}
}
