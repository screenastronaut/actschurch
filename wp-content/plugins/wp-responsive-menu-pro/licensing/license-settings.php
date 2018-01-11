<div class="wrap">
	<h2><?php echo $this->name; ?> License</h2>
	<div class="mg-reset mg-wrap">
		<div class="mg-content">
	  	<div class="mg-main">
	    	<div class="mg-row">
	     		<div class="mg-column">
	        	<div class="mg-box mg-box-validation <?php echo $license_status;?>">
	            <div class="mg-loading"></div>
	            <div class="mg-box-content">
	            	<div class="mg-validation">
	                <div class="mg-validation-graphic">
	                  <svg class="mg-validation-graphic-icon">
                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#locked">
                      </use>
                    </svg>
                    <svg class="mg-validation-graphic-icon">
                    	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#arrow-right">
                    	</use>
                    </svg>
										<svg class="mg-validation-graphic-icon">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#key">
											</use>
										</svg>
                    <svg class="mg-validation-graphic-icon">
                    	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#arrow-right">
                    	</use>
                    </svg>
                    <svg class="mg-validation-graphic-icon">
                    	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#unlocked">
                    	</use>
                    </svg>
	                </div>
	                <h1 class="mg-validation-title">You're almost there!</h1>
                  <p class="mg-validation-text">
										<?php echo $this->name; ?> is 
                    <strong class="mg-c-nope">not validated</strong>. 
                    Enter your license key below for instant access to automatic updates and support.
                  </p>
	              </div>
	            </div>
              <form action="" method="post" id="mg-license">
              	<input class="mg-form-control" id="mg-license-key" name="<?php echo $this->license; ?>" type="text" placeholder="Enter your license key and hit Enter">
                <input type="hidden" name="action" value="activate_<?php echo $this->license; ?>">
                <?php wp_nonce_field( $this->license . '_nonce', $this->license . '_nonce' ); ?>
              </form>
	          </div>
	          
	          <div class="mg-box mg-box-valid <?php echo $license_status;?>">
	          	<div class="mg-loading"></div>
							<!-- Message once the site successfully validated the license -->
              <div class="mg-validation">
	              <div class="mg-validation-graphic">
	              	<svg class="mg-validation-graphic-icon success">
	                	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#unlocked"></use>
	                </svg>
	              </div>
                <h1 class="mg-validation-title">
                	<svg class="mg-validation-graphic-icon success">
                  	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#yes"></use>
                  </svg>
                  Congrats, your license successfully activated!
                </h1>
                <br />
                <p class="mg-validation-text">
                	<?php echo $this->name; ?> is 
                  <strong class="mg-c-yep">successfully activated</strong>. 
                  You will receive automatic updates and support.
                </p>
              </div>
              <div class="mg-btn-wrap">
              	<form method="post" action="" id="mg-deactivate-license">
                  <input type="hidden" name="action" value="deactivate_<?php echo $this->license; ?>">
                  	<?php wp_nonce_field( $this->license . '_nonce', $this->license . '_nonce' ); ?>
              		<input type="submit" class="mg-deactivate" value="Deactivate license">
              	</form>
              </div>
	          </div>
	        </div>
	          
          <div class="mg-column">
            <div class="mg-box mg-box-min-height mg-box-automatic-updates">
              <header class="mg-box-header">
                <?php $lock = $license_status == 'valid' ? 'unlocked' : 'locked'; ?>
                <div class="mg-box-status mg-box-status-<?php echo $lock; ?>">
                  <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#<?php echo $lock; ?>"></use>
                  </svg>
                </div>
                <h2 class="mg-box-title">Automatic Updates &amp; Support</h2>
              </header>
              <div class="mg-box-content">
                <ul class="mg-box-features">
                  <li>
                    <svg class="mg-box-feature-icon">
                    	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#bell">
                    	</use>
                    </svg>
                    <div class="mg-box-feature-info">
                    	<h4 class="mg-box-content-title">Update Notifications</h4>
                      <span class="mg-box-content-text">
                      	Get updates on your Dashboard
                      </span>
                    </div>
                  </li>
                  <li>
                  	<svg class="mg-box-feature-icon">
                    	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#refresh"></use>
                    </svg>
                    <div class="mg-box-feature-info">
                    	<h4 class="mg-box-content-title">Stay Updated</h4>
                      <span class="mg-box-content-text">Use the latest features right away</span>
                    </div>
                  </li>
                  <li>
                  	<svg class="mg-box-feature-icon">
                    	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#dl-desktop"></use>
                    </svg>
                    <div class="mg-box-feature-info">
                    	<h4 class="mg-box-content-title">No More Manual Update</h4>
                      <span class="mg-box-content-text">Say goodbye to your FTP client</span>
                    </div>
                  </li>
									<li>
                    <svg class="mg-box-feature-icon">
                    	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#woman">
                    	</use>
                    </svg>
                    <div class="mg-box-feature-info">
                    	<h4 class="mg-box-content-title">Support by Real People</h4>
                      <span class="mg-box-content-text">A professional and courteous team</span>
                    </div>
                  </li>
                  <li>
                  	<svg class="mg-box-feature-icon">
                    	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $this->icon;?>#tfs">
                    	</use>
                    </svg>
                    <div class="mg-box-feature-info">
                    	<h4 class="mg-box-content-title">Around the Clock Support</h4>
                      <span class="mg-box-content-text">Get help at any time, day or night</span>
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
</div>