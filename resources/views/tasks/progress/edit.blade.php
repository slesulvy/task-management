<div id="progressModal"class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="modal-title"></span></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="task-id" disabled>
                    <input type="hidden" class="form-control" id="task-progress">
                    <div id="basic_slider"></div>
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