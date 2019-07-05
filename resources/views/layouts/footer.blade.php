        <div class="footer">
            <div class="pull-right">
                Copyright <strong>Task Manager &copy;</strong> 2019.
            </div>
            <!--<div>
                <strong>Copyright</strong> Task Manager &copy; 2019
            </div>-->
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- jquery UI -->
<script src="{{asset('js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- Touch Punch - Touch Event Support for jQuery UI -->
<script src="{{asset('js/plugins/touchpunch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- Custom and plugin javascript -->

@yield('customJs')


<script src="{{asset('js/inspinia.js')}}"></script>
<script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>

<script>
$(document).ready(function(){

    $('#save_category').click(function(){

        $.ajax({
            type:"get",
            url: "{{ url('addcategory')}}",
            data:{'category_name': $('#category_name').val()}, 
            success: function(result){
                $("#category_id").html(result);
                $('.addcategory').hide();
                $('#category_name').val('');
            }
        });
    });

    /*$("#todo, #inprogress, #completed").sortable({
        connectWith: ".connectList",
        update: function( event, ui ) {

            var todo = $( "#todo" ).sortable( "toArray" );
            var inprogress = $( "#inprogress" ).sortable( "toArray" );
            var completed = $( "#completed" ).sortable( "toArray" );
            $('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " + window.JSON.stringify(completed));
        }
    }).disableSelection();*/

});
</script>

</body>

</html>