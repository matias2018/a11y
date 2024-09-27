<?php


function display_a11y_banner()
{
  if (isset($_SERVER['REQUEST_URI'])) {
    $unslashed_uri = wp_unslash($_SERVER['REQUEST_URI']);
    $current_uri = esc_url_raw($unslashed_uri);
    if (!is_admin() && !strstr($current_uri, 'wp-login.php')) { ?>
      <a id="openSettings" href="#" class="a11y" data-bs-toggle="modal" data-bs-target="#settings">
        <span class="sr-only">Acessibilidade</span>
      </a>
      <div class="a11y-banner">
        <div class="a11y-message">
          <div id="settings" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="settingsTitle" aria-hidden="true"
            data-bs-backdrop="static">
            <div id="settingsDialog" class="modal-dialog position-fixed end-0 bottom-0" role="document">
              <div id="settingsContent" class="modal-content">
                <div class="modalTitle">
                  <h1 class="modal-title">WP-A11Y</h1>
                </div>
                <div id="settingsHeader" class="modal-header">
                  <p class="modal-title" id="settingsTitle">Accessibility settings</p>
                  <a type="button" id="btn-cls" class="saveAndClose" data-bs-dismiss="modal" aria-label="Close">
                    <svg fill="#74bebd" height="20px" width="20px" version="1.1" id="Capa_1"
                      xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490 490"
                      xml:space="preserve">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <polygon
                          points="456.851,0 245,212.564 33.149,0 0.708,32.337 212.669,245.004 0.708,457.678 33.149,490 245,277.443 456.851,490 489.292,457.678 277.331,245.004 489.292,32.337 ">
                        </polygon>
                      </g>
                    </svg>
                  </a>
                </div>

                <div id="modala11yBody" class="modal-body">
                  <div class="container-fuild">
                    <div class="row">
                      <div class="col-8">
                        <label class="form-check-label" for="useReducedMotion">Use Reduced Motion</label>
                      </div>
                      <div class="form-check form-switch col-md-1 ms-auto">
                        <input class="form-check-input useReducedMotion" type="checkbox" role="switch" id="useReducedMotion">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-8">
                        <label class="form-check-label" for="useDarkMode">Use Dark Mode</label>
                      </div>
                      <div class="form-check form-switch col-md-1 ms-auto">
                        <input class="form-check-input useDarkMode" type="checkbox" role="switch" id="useDarkMode">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-8">
                        <label class="form-check-label" for="useHighContrast">High Contrast</label>
                      </div>
                      <div class="form-check form-switch col-md-1 ms-auto">
                        <input class="form-check-input useHighContrast" type="checkbox" role="switch"
                          id="flexSwitchCheckChecked">
                      </div>
                    </div>
                    <hr>
                    <div class="row display_none">
                      <div class="col-8">
                        <label class="form-check-label" for="AnimationToggle">Animations</label>
                      </div>
                      <div class="form-check form-switch col-md-1 ms-auto">
                        <input class="form-check-input useAnimation" type="checkbox" role="switch" id="AnimationToggle"
                          checked>
                      </div>
                      <hr>
                    </div>
                    <div class="d-flex flex-row justify-content-between align-items-center">
                      <div>
                        <button id="decreaseFontSize" class="font-size-button" style="font-size: 12px !important;">A</button>
                        <br>
                        <small style="font-size: 10px !important;">Decrease</small><br>
                      </div>
                      <div>
                        <label for="fontSize">Font Size</label>
                      </div>
                      <div>
                        <button id="increaseFontSize" class="font-size-button" style="font-size: 24px !important;">A</button>
                        <br>
                        <small style="font-size: 10px !important;">Increase</small><br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End of Modal Settings -->
          </div>
        </div>
      </div>
      <?php
    }
    else {
      error.log('Something went wrong with the display_a11y_banner function');
      return;
    }
  }
}