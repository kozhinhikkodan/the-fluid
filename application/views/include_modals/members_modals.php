<!-- Modal-->
<div class="modal fade" id="member_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_member_add" data-form-type="member" data-modal-id="member_add_modal" method="POST" action="<?= base_url()?>committees/create_member">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_member_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Member Name</label>
                                <input type="text" id="member_name" class="form-control form_member_add_fields" name="member_name" placeholder="Member Name" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Member Contact</label>
                                <input type="number" id="member_contact" class="form-control form_member_add_fields" name="member_contact" placeholder="Member Contact" min="0" maxlength="10" minlength="10" />
                            </div>
                        </div>
                    </div>

                    <?php if($this->session->userdata('user_role')=='admin') { ?>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group ">
                                    <label for="expense_head">Committee <span class="text-danger">*</span></label>
                                    <select required style="width: 100%" class="form-control form_member_add_select" name="committee" id="committee_add">
                                        <option selected disabled>Select Committee</option>
                                        <?php foreach ($committees as $key => $value) { ?>
                                            <option value="<?= $value->committee_id ?>"><?= $value->committee_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    <?php if($this->session->userdata('user_role')=='committee') { ?>
                        <input type="hidden" name="committee" value="<?= $this->session->userdata('committee_data')->committee_id ?>">
                    <?php } ?>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold form_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="member_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_member_edit" data-form-type="member" data-modal-id="member_edit_modal" method="POST" action="<?= base_url()?>committees/update_member">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="committee_id_edit" name="committee_id">
                    <input type="hidden" id="committee_member_user_id_edit" name="user_id">


                    <div class="form_member_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Member Name</label>
                                <input type="text" id="member_name_edit" class="form-control form_member_edit_fields" name="member_name" placeholder="Member Name" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Member Contact</label>
                                <input type="number" id="member_contact_edit" class="form-control form_member_edit_fields" name="member_contact" placeholder="Member Contact" min="0" minlength="10" maxlength="10" />
                            </div>
                        </div>
                    </div>

                    <?php if($this->session->userdata('user_role')=='admin') { ?>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group ">
                                    <label for="expense_head">Committee <span class="text-danger">*</span></label>
                                    <select required style="width: 100%" class="form-control form_member_edit_select" name="committee" id="committee_edit">
                                        <option selected disabled>Select Committee</option>
                                        <?php foreach ($committees as $key => $value) { ?>
                                            <option value="<?= $value->committee_id ?>"><?= $value->committee_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    <?php if($this->session->userdata('user_role')=='committee') { ?>
                        <input type="hidden" name="committee" value="<?= $this->session->userdata('committee_data')->committee_id ?>">
                    <?php } ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold form_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="member_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="member" data-modal-id="member_delete_modal" action="<?= base_url()?>committees/delete_member">
                <div class="modal-body bg-danger">
                    <h2 class="modal-title text-white">Are you sure ? </h2>
                    <h5 class="modal-title text-white">This action can not be reversed</h5>
                    <hr>

                    <input type="hidden" id="member_id_delete" name="member_id">
                    <input type="hidden" id="committee_id_delete" name="committee_id">
                    <input type="hidden" id="committee_member_user_id_delete" name="user_id">

                    <div class="row">
                        <div class="col-md-5"></div>
                        <button type="button" class="btn btn-white text-dark font-weight-bold mr-1" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-white font-weight-bold text-danger form_submit">Confirm and Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
