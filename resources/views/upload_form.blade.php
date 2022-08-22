<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Image upload</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <form action="api/images/add" method="post" enctype="multipart/form-data">
            <label for="images">Images</label>
            <input type="file" name="images[]" multiple>
            <input type="file" name="images[]" multiple>
            <button type="submit">submit</button>
        </form>

        <script src="{{ asset('assets/js/script.js') }}"></script>
    </body>

</html>
