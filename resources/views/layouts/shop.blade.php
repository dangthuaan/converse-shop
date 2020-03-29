<!DOCTYPE html>
<html lang="en">

@include('layouts.includes.head')

<body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>

  @include('layouts.includes.header')

  @yield('content')

  @include('layouts.includes.footer')

  @include('layouts.includes.script')
</body>

</html>
