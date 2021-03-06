<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div>
  <a href=#ab_new_customer_dialog class="{{btn_class}}" data-toggle=modal data-backdrop={{backdrop}}><?php _e( 'New customer' , 'ab' ) ?></a>
  <div id="ab_new_customer_dialog" class="modal hide fade" tabindex=-1 role=dialog aria-labelledby=myModalLabel aria-hidden=true>
    <div class="dialog-content">
      <form style="margin-bottom: 0;" ng-hide=loading>
        <div class="modal-header">
          <button type=button class=close data-dismiss=modal aria-hidden=true>×</button>
          <h3 id="myModalLabel"><?php _e( 'New Customer', 'ab' ) ?></h3>
        </div>
        <div class="modal-body">

            <fieldset>
                <legend><?php _e( 'Personal Information', 'ab' ) ?></legend>
                <!--div class="control-group">
                    <label><?php _e( 'User' , 'ab' ) ?></label>
                    <select ng-model="form.wp_user_id">
                        <option value=""></option>
                        <?php foreach ( $wp_users as $wp_user ): ?>
                            <option value="<?php echo $wp_user->ID ?>">
                                <?php echo $wp_user->display_name ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div-->
                <div class="control-group">
                    <label><?php _e( 'Name' , 'ab' ) ?></label>
                    <input type="text" ng-model="form.name" />
                    <span style="font-size: 11px;color: red" ng-show="errors.name.required"><?php _e( 'Required' , 'ab' ) ?></span>
                </div>
                <div class="control-group">
                    <label><?php _e( 'Phone' , 'ab' ) ?></label>
                    <input type="text" ng-model=form.phone />
                </div>
                <div class="control-group">
                    <label><?php _e( 'Email' , 'ab' ) ?></label>
                    <input type="text"  ng-model=form.email />
                </div>
                <div class="control-group">
                    <label><?php _e( 'Address' , 'ab' ) ?></label>
                    <input type="text"  ng-model=form.address />
                </div>
                <div class="control-group">
                    <label><?php _e( 'Notes' , 'ab' ) ?></label>
                    <textarea ng-model=form.notes></textarea>
                </div>
            </fieldset>

            <?php if ($module !== 'customer'): ?>
                <fieldset>
                    <legend><?php _e( 'Custom Fields', 'ab' ) ?></legend>
                    <div class="new-customer-custom-fields">
                        <?php foreach ( $custom_fields as $custom_field ): ?>
                            <div class="control-group" data-type="<?php echo $custom_field->type ?>" data-id="<?php echo $custom_field->id ?>">
                                <label><?php echo $custom_field->label ?></label>

                                <?php if ( $custom_field->type == 'text-field' ): ?>
                                    <input type="text" class="ab-custom-field" />

                                <?php elseif ( $custom_field->type == 'textarea' ): ?>
                                    <textarea rows="3" class="ab-custom-field"></textarea>

                                <?php elseif ( $custom_field->type == 'checkboxes' ): ?>
                                    <?php foreach ( $custom_field->items as $item ): ?>
                                        <label><input class="ab-custom-field" type="checkbox" value="<?php echo esc_attr( $item ) ?>" /> <?php echo $item ?></label>
                                    <?php endforeach ?>

                                <?php elseif ( $custom_field->type == 'radio-buttons' ): ?>
                                    <?php foreach ( $custom_field->items as $item ): ?>
                                        <label><input type="radio" name="<?php echo $custom_field->id ?>" class="ab-custom-field" value="<?php echo esc_attr( $item ) ?>" /> <?php echo $item ?></label>
                                    <?php endforeach ?>

                                <?php elseif ( $custom_field->type == 'drop-down' ): ?>
                                    <select class="ab-custom-field">
                                        <option value=""></option>
                                        <?php foreach ( $custom_field->items as $item ): ?>
                                            <option value="<?php echo esc_attr( $item ) ?>"><?php echo $item ?></option>
                                        <?php endforeach ?>
                                    </select>

                                <?php endif ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </fieldset>
            <?php endif; ?>

        </div>
        <div class=modal-footer>
          <div class=ab-modal-button>
            <button ng-click=processForm() class="btn btn-info ab-popup-save ab-update-button"><?php _e( 'Create customer' , 'ab' ) ?></button>
            <button class=ab-reset-form data-dismiss=modal aria-hidden=true><?php _e( 'Cancel' , 'ab' ) ?></button>
          </div>
        </div>
      </form>
      <div ng-show=loading class=loading-indicator>
        <img src="<?php echo plugins_url( 'backend/resources/images/ajax_loader_32x32.gif', AB_PATH . '/main.php' ) ?>" alt="" />
      </div>
    </div>
  </div>
</div>