<!DOCTYPE html>
<html lang="en">
<head>
    <title>Files</title>
</head>
<body>

<h1>Files</h1>
<p>Supported extensions: {{ $supportedExtensions }}</p>
<form action="{{route('file-sharing.upload')}}" method="post" enctype="multipart/form-data">
    @csrf
    @if (!empty($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="file" name="file">
    <input type="submit" />
</form>
<br />
<table border="1">
@foreach($files as $file)
    <tr>
        <td>{{ $file['name'] }}</td>
        <td><a href="{{ route('file-sharing.download', ['fileSlug' => $file['slug']]) }}">Download</a></td>
    </tr>
@endforeach
</table>
</body>
</html>
