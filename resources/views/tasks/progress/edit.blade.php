<div id="progressModal"class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="task-id" disabled>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="body">Progress</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="task-progress">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn actionBtn" data-dismiss="modal">
                    <span id="footer_action_button" class="glyphicon"></span>
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <i class="fa fa-close"></i> close
                </button>
            </div>
        </div>
    </div>
</div>