<!-- Modal-->
<div class="modal fade" id="hospital_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_hospital_add" data-form-type="hospital" data-modal-id="hospital_add_modal" method="POST" action="<?= base_url()?>hospitals/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Hospital</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_hospital_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Hopital Name <span class="text-danger">*</span></label>
                                <input required type="text" id="name" class="form-control form_hospital_add_fields" name="name" placeholder="Hospital Name"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <input required type="text" id="location" class="form-control form_hospital_add_fields" name="location" placeholder="Location"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contact No <span class="text-danger">*</span></label>
                                <input required type="number" id="contact" class="form-control phone_number_fields form_hospital_add_fields" name="contact" placeholder="Contact No" maxlength="10" minlength="10" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea rows="3" id="address" type="text" class="form-control form_hospital_add_fields" name="address" placeholder="Address" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="3" id="description" type="text" class="form-control form_hospital_add_fields" name="description" placeholder="Description" ></textarea>
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
<div class="modal fade" id="hospital_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_hospital_edit" data-form-type="hospital" data-modal-id="hospital_edit_modal" method="POST" action="<?= base_url()?>hospitals/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Hospital</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_hospital_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="hospital_id_edit" name="hospital_id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Hopital Name <span class="text-danger">*</span></label>
                                <input required type="text" id="name_edit" class="form-control form_hospital_edit_fields" name="name" placeholder="Hospital Name"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <input required type="text" id="location_edit" class="form-control form_hospital_edit_fields" name="location" placeholder="Location"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contact No <span class="text-danger">*</span></label>
                                <input required type="number" id="contact_edit" class="form-control phone_number_fields form_hospital_edit_fields" name="contact" placeholder="Contact No" min="0" maxlength="10" minlength="10"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea rows="3" id="address_edit" type="text" class="form-control form_hospital_edit_fields" name="address" placeholder="Address" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="3" id="description_edit" type="text" class="form-control form_hospital_edit_fields" name="description" placeholder="Description" ></textarea>
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
<div class="modal fade" id="hospital_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="hospital" data-modal-id="hospital_delete_modal" action="<?= base_url()?>hospitals/delete">
                <div class="modal-body bg-danger">
                    <h2 class="modal-title text-white">Are you sure ? </h2>
                    <h5 class="modal-title text-white">This action can not be reversed</h5>
                    <hr>

                    <input type="hidden" id="hospital_id_delete" name="hospital_id">

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
