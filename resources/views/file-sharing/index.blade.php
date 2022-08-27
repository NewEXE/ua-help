<!DOCTYPE html>
<html lang="en">
<head>
    <title>Files</title>
</head>
<body>

<h1>Simple file sharing</h1>
<p>
    Supported extensions: {{ $supportedExtensions }}.<br />
    Max filesize: {{ $maxFilesize }} Kilobytes.
</p>
<form action="{{route('file-sharing.upload')}}" method="post" enctype="multipart/form-data">
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
    <input type="file" name="file">
    <input type="submit" />
</form>
<br />
<table border="1">
    <tr>
        <td>Filename</td>
        <td>Direct download link</td>
        <td>Will be deleted at</td>
        <td></td>
    </tr>
@foreach($files as $file)
    <tr>
        <td>{{ $file->name }}</td>
        <td>{{ route('file-sharing.download', ['fileSlug' => $file->slug]) }}</td>
        <td>{{ $file->deletedAtForHumans() }}</td>
        <td><a href="{{ route('file-sharing.download', ['fileSlug' => $file->slug]) }}">Download</a></td>
    </tr>
@endforeach
</table>
</body>
</html>
