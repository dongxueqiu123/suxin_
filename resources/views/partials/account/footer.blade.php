<footer class="main-footer">
  <p>
    <strong>Copyright &copy; <span id="year"></span> Suxin.</strong> All rights reserved. &nbsp;&nbsp;&nbsp;苏ICP备 18009421号-1
            &nbsp;&nbsp;苏公网安备 32011402010278号</p>
</footer>

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>

<script>
  $("#year").html(new Date().getFullYear());
</script>