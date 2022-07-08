<!DOCTYPE html>
<html lang="en" class="box-border">
<!---
  STARTING TEMPLATE FOR MVC-APP IN LARAVEL
-->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content={{ csrf_token() }}>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>Chateau Meiland</title>
</head>

<body>

    @include('partials.header')

    <main class="container mx-auto w-8/12">

        @yield('content')

    </main>

  @include('partials.footer')

</body>

</html>
