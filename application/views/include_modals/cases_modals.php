<!-- Modal-->
<div class="modal fade" id="case_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_case_add" data-form-type="case" data-modal-id="case_add_modal" method="POST" action="<?= base_url()?>cases/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Case</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_case_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Case Date</label>
                                <input type="text" id="case_date" class="form-control" name="case_date" placeholder="Case Date" value="<?= date('d-m-Y') ?>" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group ">
                                <label for="expense_head">Group <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_case_add_select" name="group" id="case_group">
                                    <option selected disabled>Select Group</option>
                                    <?php foreach (config_item('blood_groups') as $key => $value) { ?>
                                        <option><?= $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Units</label>
                                <input type="text" id="units" class="form-control form_case_add_fields" name="units" placeholder="Units" />
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <?php if($page!='hospital_profile'){ ?>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group ">
                                    <label for="expense_head">Hospital <span class="text-danger">*</span></label>
                                    <select required style="width: 100%" class="form-control form_case_add_select" name="hospital" id="case_hospital">
                                        <option selected disabled>Select Hospital</option>
                                        <?php foreach ($hospitals as $key => $value) { ?>
                                            <option value="<?= $value->hospital_id ?>"><?= $value->hospital_name.' - '.$value->location ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        <?php } else{ ?>
                            <input type="hidden" name="hospital" value="<?= $hospital_data->hospital_id ?>">
                        <?php } ?>

                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Patient Name <span class="text-danger">*</span></label>
                                <input required type="text" id="patient_name" class="form-control form_case_add_fields" name="patient_name" placeholder="Patient Name"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Patient Contact</label>
                                <input type="number" id="patient_contact" min="0" minlength="10" maxlength="10" class="form-control form_case_add_fields" name="patient_contact" placeholder="Patient Contact"/>
                            </div>
                        </div>

                        

                    </div>


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
<div class="modal fade" id="case_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_case_edit" data-form-type="case" data-modal-id="case_edit_modal" method="POST" action="<?= base_url()?>cases/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Case</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_case_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <input type="hidden" name="case_id" id="case_id_edit">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Case Date</label>
                                <input type="text" id="case_date_edit" class="form-control" name="case_date" placeholder="Case Date" value="<?= date('d-m-Y') ?>" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group ">
                                <label for="expense_head">Group <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_case_edit_select" name="group" id="case_group_edit">
                                    <option selected disabled>Select Group</option>
                                    <?php foreach (config_item('blood_groups') as $key => $value) { ?>
                                        <option><?= $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Units</label>
                                <input type="text" id="units_edit" class="form-control form_case_edit_fields" name="units" placeholder="Units" />
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group ">
                                <label for="expense_head">Hospital <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_case_edit_select " name="hospital" id="case_hospital_edit">
                                    <option selected disabled>Select Hospital</option>
                                    <?php foreach ($hospitals as $key => $value) { ?>
                                        <option value="<?= $value->hospital_id ?>"><?= $value->hospital_name.' - '.$value->location ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Patient Name <span class="text-danger">*</span></label>
                                <input required type="text" id="patient_name_edit" class="form-control form_case_edit_fields" name="patient_name" placeholder="Patient Name"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Patient Contact</label>
                                <input type="number" min="0" minlength="10" maxlength="10" id="patient_contact_edit" class="form-control form_case_edit_fields" name="patient_contact" placeholder="Patient Contact"/>
                            </div>
                        </div>

                    </div> 

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
<div class="modal fade" id="case_close_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_case_close" data-form-type="case" data-modal-id="case_close_modal" method="POST" action="<?= base_url()?>cases/update_status">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Udate Case Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_case_close_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <input type="hidden" name="case_id" id="case_id_close">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Case Status <span class="text-danger">*</span></label>
                            <div class="radio-inline">
                              <label class="radio radio-success">
                                <input type="radio" value="1" name="status" class="form_case_close_radio" />
                                <span></span>
                                Close
                            </label>
                            <label class="radio radio-danger">
                                <input type="radio" value="0" name="status" class="form_case_close_radio" />
                                <span></span>
                                Open
                            </label>
                        </div>
                    </div> 
                </div> 
            </div>


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
<div class="modal fade" id="case_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="case" data-modal-id="case_delete_modal" action="<?= base_url()?>cases/delete">
                <div class="modal-body bg-danger">
                    <h2 class="modal-title text-white">Are you sure ? </h2>
                    <h5 class="modal-title text-white">This action can not be reversed</h5>
                    <hr>

                    <input type="hidden" id="case_id_delete" name="case_id">

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
