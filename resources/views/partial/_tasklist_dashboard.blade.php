
        <li progres_id="{{$item->id}}" class="{{$item->id}} default-element ui-sortable-handle btn-update-task" id="_{{$item->id}}" style="" data-Id="{{$item->id}}" data-toggle="modal" data-target="#taskmodal">
            <div class="agile-detail" style="padding:0 0 5px 0; text-align:left; margin-top:0px;">

            </div>
            {{$item->taskname}}
            <div class="agile-detail">

                <span title="Due Date" class=""><i class="fa fa-clock-o"></i> {{($item->due_date!=null?date_format(date_create($item->due_date),'d-M-Y'):'')}}</span>
                <a href="#" class="btn btn-xs pull-right" style="border:none;">
                    <?php $inc_member=0;?>
                    @foreach ($item->handler as $val)
                        @if($inc_member<5)
                            <img title="{{$val->getUser->name}}" src="<?php echo asset("img/".$val->getUser->img."")?>" width="17px;" class="img img-circle">
                        @endif
                        <?php $inc_member++;?>
                    @endforeach
                    @if($inc_member>=5)
                        {{$inc_member}}+
                    @endif
                </a>

                <div class="progress" style="margin-top:10px;">
                    <div class="progress-bar progress-bar-striped @if ($item->priority == 2) progress-bar-info @elseif ($item->priority == 3) progress-bar-danger @else @endif task-progress" role="progressbar" style="width: {{ $item->progress }}%" aria-valuenow="{{ $item->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

        </li>
