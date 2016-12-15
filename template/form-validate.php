<div class="row">
<div class="col-lg-12">
    <!-- Material Forms Validation -->
    <h2 class="content-heading">Material Forms</h2>
    <div class="block">
        <div class="block-header">
            <ul class="block-options">
                <li>
                    <button type="button"><i class="si si-settings"></i></button>
                </li>
            </ul>
            <h3 class="block-title">Validation</h3>
        </div>
        <div class="block-content block-content-narrow">
            <!-- jQuery Validation (.js-validation-material class is initialized in js/pages/base_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation-material form-horizontal push-10-t" action="base_forms_validation.html" method="post">
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="val-username2" name="val-username2" placeholder="Choose a nice username..">
                            <label for="val-username2">Username</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="val-email2" name="val-email2" placeholder="Enter your valid email..">
                            <label for="val-email2">Email</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="password" id="val-password2" name="val-password2" placeholder="Choose a good one..">
                            <label for="val-password2">Password</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="password" id="val-confirm-password2" name="val-confirm-password2" placeholder="..and confirm it to be safe!">
                            <label for="val-confirm-password2">Confirm Password</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <select class="js-select2 form-control" id="val-select22" name="val-select22" style="width: 100%;" data-placeholder="Choose one..">
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1">HTML</option>
                                <option value="2">CSS</option>
                                <option value="3">JavaScript</option>
                                <option value="4">PHP</option>
                                <option value="5">MySQL</option>
                                <option value="6">Ruby</option>
                                <option value="7">AngularJS</option>
                            </select>
                            <label for="val-select2">Select2</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <select class="js-select2 form-control" id="val-select2-multiple2" name="val-select2-multiple2" style="width: 100%;" data-placeholder="Choose at least two.." multiple>
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1">HTML</option>
                                <option value="2">CSS</option>
                                <option value="3">JavaScript</option>
                                <option value="4">PHP</option>
                                <option value="5">MySQL</option>
                                <option value="6">Ruby</option>
                                <option value="7">AngularJS</option>
                            </select>
                            <label for="val-select2-multiple2">Select2 Multiple</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material">
                            <textarea class="form-control" id="val-suggestions2" name="val-suggestions2" rows="3" placeholder="Share your ideas with us.."></textarea>
                            <label for="val-suggestions2">Suggestions</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <select class="form-control" id="val-skill2" name="val-skill2">
                                <option value="">Please select</option>
                                <option value="html">HTML</option>
                                <option value="css">CSS</option>
                                <option value="javascript">JavaScript</option>
                                <option value="ruby">Ruby</option>
                                <option value="php">PHP</option>
                                <option value="asp">ASP.NET</option>
                                <option value="python">Python</option>
                                <option value="mysql">MySQL</option>
                            </select>
                            <label for="val-skill2">Best Skill</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="val-currency2" name="val-currency2" placeholder="$30.50">
                            <label for="val-currency2">Currency</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="val-phoneus2" name="val-phoneus2" placeholder="212-999-0000">
                            <label for="val-phoneus2">Phone (US)</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="val-website2" name="val-website2" placeholder="http://example.com">
                            <label for="val-website2">Website</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="val-digits2" name="val-digits2" placeholder="3">
                            <label for="val-digits2">Digits</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="val-number2" name="val-number2" placeholder="3.0">
                            <label for="val-number2">Number</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="val-range2" name="val-range2" placeholder="3">
                            <label for="val-range2">Range [1, 5]</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div>
                            <label><a data-toggle="modal" data-target="#modal-terms" href="#">Terms</a> <span class="text-danger">*</span></label>
                        </div>
                        <label class="css-input css-checkbox css-checkbox-primary" for="val-terms2">
                            <input type="checkbox" id="val-terms2" name="val-terms2" value="1"><span></span> I agree to the terms
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Material Forms Validation -->
</div>
</div>

<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/js/app.js') ?>"></script>
<script src="<?php echo base_url('template/js/plugins/select2/select2.full.min.js') ?>"></script>
<script src="<?php echo base_url('template/js/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?php echo base_url('template/js/plugins/jquery-validation/additional-methods.min.js') ?>"></script>
<script>
    jQuery(function () {
        App.initHelpers('select2');
    });
</script>
<script src="<?php echo base_url('template/js/pages/base_forms_validation.js') ?>"></script>