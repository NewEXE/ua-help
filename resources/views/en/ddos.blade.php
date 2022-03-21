@extends('layouts.app')

@section('title', __('DDoS attack'))

@section('content')
    <p>How can you significantly complicate the life of the aggressor? <b>Let's make their war-important sites not work</b>:</p>
    <ul>
        <li>propaganda sites (kremlin.ru, gazeta.ru, ria.ru, smi2.ru, russian.rt.com and others)</li>
        <li>sites of banks (sber.ru and others)</li>
        <li>logistics sites...</li>
        ...and others helping the Führer of the 21st century kill our citizens.
    </ul>
    <p>
        You do not need to be an IT specialist, just "visit" these sites many times (make requests to these sites).
        Site servers will not withstand the load and will stop working, especially when you connect.
        This is called a <b>DDoS attack</b>.
    </p>
    <p>So <b>how can I join the IT army?</b> Don't worry, you don't need to reload the page a million times, just:</p>
    <ul>
        <li>run a special software <span class="text-muted">or even</span></li>
        <li>just go to a specialized site</li>
    </ul>
    <p>Having a computer, laptop or smartphone, <b>you can help</b>, not being an experienced user, <b>without special skills</b>.</p>
    <p>This requires:</p>
    <ul>
        <li>device - desktop, laptop or smartphone;</li>
        <li>internet-connection, preferably unlimited and stable.</li>
    </ul>

    <h4>Very simple level <em>(without VPN)</em></h4>

    <ol>
        <li>
            <p>
                <b>UA Cyber SHIELD</b> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i>🐧)
            </p>
            <p>
                All you need to do is download the program and run it (there are versions for Windows, Mac and Linux).
                This can be done from official sources:
            </p>
            <p>
                <ul>
                    <li><a target="_blank" href="https://help-ukraine-win.com.ua/help-ukraine-win-en/the-easiest">Installation manual</a></li>
                    <li><a href="https://t.me/uashield" target="_blank">Telegram-channel</a></li>
                    <li><a href="https://github.com/opengs/uashield/releases/latest" target="_blank">Github releases</a></li>
                </ul>
            </p>
            <p>
                How does it work?
                Attacks a list of sites that change dynamically on their own, using a proxy, so you're safe - <b>your IP address and location are hidden</b>.
                <a href="https://github.com/opengs/uashield">This is open-source software</a>.
            </p>
        </li>
    </ol>

    <p>That's all! However, for more effective attacks, use simple and advanced levels: </p>

    <div class="spoiler">
        <input type="checkbox" id="other-attack-levels">
        <label for="other-attack-levels">
            <h5>
                <i class="bi bi-caret-right-square"></i>
                <span class="link-primary text-decoration-underline">Open simple and advanced levels - click here</span>
                <i class="bi bi-caret-left-square"></i>
            </h5>
        </label>
        <div>
            Work in progress... Please come back tomorrow!
        </div>
    </div>
@endsection
