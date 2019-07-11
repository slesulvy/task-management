
<div class="modal in" id="myModal5" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
    <div class="modal-dialog  modal-md" style="border-radius:0px;">
        <div class="modal-content animated bounceInDown">
            <form id="pr" method="post" enctype="multipart/form-data" action="{{ route('board/addnew') }}">
                @csrf
                <div class="modal-header back-change" style="padding:7px 14px 5px 14px; ">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class=""><b>Add Project</b></h3>
                </div>
                <div class="modal-body">
                    <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12">Project Name <span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="projectname" id="projectname" class="form-control" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12">Category <span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <select name="category_id" id="category_id" class="form-control" required style="width:85%; border-radius:0px; float:left;">
                                        @foreach ($category as $item)
                                            <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-default" onclick="$('.addcategory').toggle();" href="javascript:void(0)" style="width:15%; float:left; border-radius:0px;"><i class="fa fa-plus"></i></a>
                                </div>

                                <div class="col-sm-12 addcategory" style="display:none;">
                                    <div class="col-sm-12 input-group" style="background:#fff; padding:5px 0;">
                                        <input id="category_name" name="category_name" value="" type="text" class="form-control" placeholder="Add new category...">
                                        <span class="input-group-btn">
                                                <button type="button" id="save_category" class="btn btn-default"><i class="fa fa-save"></i></button>
                                            </span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div id="bgpicker" class="input-group colorpicker-component">
                                        <input type="text" value="#1ab394" class="form-control" id="back_color" name="back_color" />
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div id="fgpicker" class="input-group colorpicker-component">
                                        <input type="text" value="#ffffff" class="form-control" id="font_color" name="font_color" />
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-12">Description <span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <textarea name="description" style="width:100%;border:1px solid #eee;" rows="8" required></textarea>
                                </div>
                            </div>

                        </div>

                    </fieldset>

                </div>
                <div class="modal-footer" style="border:0px solid #000; padding-right:46px; margin-top:15px;">
                    &nbsp;<br>
                    <button type="reset" class="btn btn-white close_md" data-dismiss="modal" style="border-radius:0px;">Close</button>
                    <button type="submit" class="btn btn-primary back-change" style="border-radius:0px;">Save</button>

                </div>
            </form>
        </div>
    </div>
</div>
