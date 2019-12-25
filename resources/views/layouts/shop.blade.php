<!DOCTYPE html>
<html lang="en">

  @include('layouts.includes.head')

  <body>

    @include('layouts.includes.header')

    @yield('content')

    @include('layouts.includes.footer')

    @include('layouts.includes.script')

  </body>
</html>
