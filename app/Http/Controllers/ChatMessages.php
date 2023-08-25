<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use voku\helper\UTF8;

class ChatMessages extends Controller
{
    public function __construct()
    {
        $this->middleware('doNotCacheResponse');
        parent::__construct();
    }

    /**
     * Show chat messages list.
     *
     * @return View
     */
    public function index(): View
    {
        $chatMessages = ChatMessage::latest()->get(['content', 'created_at']);

        return view('chat-messages.index', compact(
            'chatMessages'
        ));
    }

    /**
     * Create chat message, then redirects to the back.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        // Validate input file.
        $validated = $request->validate([
            'content' => [
                'required',
                'string',
                'min:1',
                'max:10000',
            ],
        ]);

        $content = $this->sanitizeString($validated['content']);

        ChatMessage::create([
            'content' => $content,
            'created_by_ip' => $request->ip(),
        ]);

        return back();
    }

    /**
     * 1) Cast input to string;
     * 2) normalizes to UTF-8 NFC, converting from WINDOWS-1252 when needed;
     * 3) strip HTML and PHP tags from a string;
     * 4) convert all applicable characters to HTML entities;
     * 5) remove invisible characters (like "\0");
     * 6) optionally apply >= 8-Bit safe trim().
     *
     * @param mixed $string
     * @param bool $applyTrim
     * @return string
     */
    private function sanitizeString($string, bool $applyTrim = true): string
    {
        // 1) Cast input to string
        $string = UTF8::to_string($string ?? '');

        $string =
            // 5) remove invisible characters (like "\0")
            UTF8::remove_invisible_characters(
            // 4) convert all applicable characters to HTML entities
                UTF8::html_escape(
                // 3) strip HTML and PHP tags from a string
                    UTF8::remove_html(
                    // 2) normalizes to UTF-8 NFC, converting from WINDOWS-1252 when needed
                        UTF8::filter($string)
                    )
                )
            );

        // 6) optionally apply multibyte-safe trim()
        if ($applyTrim) {
            $string = UTF8::trim($string);
        }

        return $string;
    }
}
