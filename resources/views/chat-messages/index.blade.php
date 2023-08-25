<!DOCTYPE html>
<html lang="en">
<head>
    <title>Повідомлення</title>
</head>
<body>

<h1>Повідомлення</h1>
<form action="{{route('chat-messages.create')}}" method="post" enctype="multipart/form-data">
    @csrf
    @if (count($errors))
        <p><b>Errors:</b></p>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <textarea name="content"></textarea>
    <input type="submit" value="Надіслати" />
</form>
<br />
<table border="1">
    <tr>
        <td>Текст</td>
    </tr>
    @foreach($chatMessages as $message)
        <tr>
            <td>{{ $message->content }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
