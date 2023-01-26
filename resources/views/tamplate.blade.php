<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Permata Zakat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="./css/sidebar.css"> -->
  <link rel="stylesheet" href="{{ url('css/sidebar.css')}}">

</head>
<style>

</style>

<body class="bg-light">
  <div id="sidebar">
    <input type="checkbox" checked="true" id="check" onclick="toggleSideNav()" />
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>My App</header>

      <ul>
        <li>
          <a href="#"><i class="fas fa-qrcode"></i>Dashboard</a>
        </li>
        <li>
          <a href="#"><i class="fas fa-calendar-week"></i>Events</a>
        </li>
        <li>
          <a href="#"><i class="far fa-question-circle"></i>About</a>
        </li>
        <li>
          <a href="./"><i class="fas fa-sliders-h"></i>Logout</a>
        </li>
      </ul>
    </div>
  </div>
  <!-- <section> -->

  <main>
    <div id="content-main" class="">
      <div class="container">
        <!-- @include('pesan') -->

        @yield('konten')
      </div>
    </div>
  </main>
  <!-- </section> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script>
    window.addEventListener('load',
      function() {
        
        // alert('hello!');
        // document.getElementById("check").checked = true;
        var btn = document.body.querySelector('#check');
        var content = document.querySelector("#content-main");
      if (btn.checked != true) {
        content.classList.add("sidebar-checked");
      } else {
        content.classList.remove("sidebar-checked");
      }
      }, false);

    function toggleSideNav() {
      var content = document.querySelector("#content-main");
      if (document.body.querySelector('#check').checked != true) {
        content.classList.add("sidebar-checked");
      } else {
        content.classList.remove("sidebar-checked");
      }
    }
  </script>
</body>

</html>