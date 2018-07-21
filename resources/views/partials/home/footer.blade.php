<footer class="footer" style="position: static;">
  <div class="footer_main">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="b_section">
            <div class="row">
              <div class="col-xs-12 col-sm-3 col-md-3">
                <ul>
                  <li><p>@lang('common.footer.about_label')</p></li>
                  <li><a href="<?php echo url('/').'/'.app()->getLocale() ?>">@lang('header.menu.home_lnk')</a></li>
                  <li><a href="<?php echo url('/').'/'.app()->getLocale().'/contact_us' ?>">@lang('header.menu.contact_us')</a></li>
                </ul>
              </div>
              <div class="col-xs-12 col-sm-3 col-md-3">
                <ul>
                  <li><p>@lang('common.footer.products_label')</p></li>
                  <li><a href="<?php echo url('/').'/'.app()->getLocale().'/sensors' ?>">@lang('header.menu.sensors_lnk')</a></li>
                  <li><a href="<?php echo url('/').'/'.app()->getLocale().'/connectivity' ?>">@lang('header.menu.connectivity_lnk')</a></li>
                </ul>
              </div>
              <div class="col-xs-12 col-sm-3 col-md-3">
                <ul>
                  <li><p>@lang('common.footer.services_label')</p></li>
                  <li><a href="<?php echo url('/').'/'.app()->getLocale().'/cloud' ?>">@lang('header.menu.industrial_lnk')</a></li>
                  <li><a href="<?php echo url('/').'/'.app()->getLocale().'/analytics' ?>">@lang('header.menu.analytics_lnk')</a></li>
                </ul>
              </div>
              <div class="col-xs-6 col-sm-3 col-md-3">
                <ul>
                  <li><p>@lang('common.footer.langauge_label')</p></li>
                  <li>
                    <div class="language">
                      <div class="pure-css-select-style theme-default">
                        <select id="language_selector">
                          <option <?php echo (app()->getLocale() === 'ch') ? '' : 'selected' ?> value="en">English</option>
                          <option <?php echo (app()->getLocale() === 'ch') ? 'selected' : '' ?> value="ch">简体中文</option>
                        </select>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <div class="footer_sec">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <p>
            <strong>Copyright &copy; <span id="year"></span> Suxin.</strong> All rights reserved. &nbsp;&nbsp;&nbsp;苏ICP备 18009421号-1
            &nbsp;&nbsp;苏公网安备 32011402010278号</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
  $("#year").html(new Date().getFullYear());
</script>