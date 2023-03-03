<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Http\UploadedFile;

class FileSharingUpload implements InvokableRule
{
    public const SUPPORTED_MIMES = [
        'application/x-mobipocket-ebook',
        'application/x-fictionbook+xml',
        'application/vnd.amazon.ebook',
        'application/epub+zip',
        'application/book',
        'text/plain',
        'application/pdf',
        'application/msword',
        'text/rtf',
        'text/html',
        'text/xml',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/x-bittorrent',
        'image/x-png',
        'image/jpeg',
    ];

    private const DEFAULT_MIME = 'application/octet-stream';

    private const MIMES_THAT_CAN_BE_UNDETECTED = [
        'application/x-mobipocket-ebook',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];

    private const INVALID_MIME_MESSAGE = 'The :attribute has invalid mime.';

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  UploadedFile|mixed $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        if (!$value instanceof UploadedFile) {
            $fail('The :attribute must be a uploaded file.');
        }

        $mime = $value->getMimeType();

        if ($mime === self::DEFAULT_MIME) {
            $unsafeMime = $value->getClientMimeType();

            if (!in_array($unsafeMime, self::MIMES_THAT_CAN_BE_UNDETECTED, true)) {
                $fail(self::INVALID_MIME_MESSAGE);
            }

            return;
        }

        if (!in_array($mime, self::SUPPORTED_MIMES, true)) {
            $fail(self::INVALID_MIME_MESSAGE);
        }
    }
}
