
        <li progres_id="{{$item->id}}" class="{{$item->id}} default-element ui-sortable-handle btn-update-task" id="_{{$item->id}}" style="" data-Id="{{$item->id}}" data-toggle="modal" data-target="#modalmodal">
         <!--    <input type="" name="" id="tests" value="{{$item->id}}"> -->
            <div class="agile-status">
                <div class="task-priority">
                    <?php $j=3;?>
                    @for ($i = 1; $i <= $item->priority; $i++)
                        <i class="fa fa-star"></i>&nbsp;
                        <?php $j--;?>
                    @endfor
                    @for ($j; $j >= 1; $j--)
                        <i class="fa fa-star-o"></i>&nbsp;
                    @endfor
                </div>
                <div class="progress priority-{{ $item->priority }}" style="margin-top:3.5px;">
                    <div class="progress-bar progress-bar-striped task-progress progress-bar-{{ $item->priority }}" role="progressbar" style="width: {{ $item->progress }}%" aria-valuenow="{{ $item->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div id="clear" style="clear:both;"></div>
            {{$item->taskname}}
            <div class="agile-detail">

                <span title="Due Date" class=""><i class="fa fa-clock-o"></i> {{($item->due_date!=null?date_format(date_create($item->due_date),'d-M-Y'):'')}}</span>
                <a href="#" class="btn btn-xs pull-right" style="border:none;">
                    <?php $inc_member=0;?>
                    @foreach ($item->handler as $val)
                        @if($inc_member<5)
                            <img title="{{$val->getUser->name}}" src="<?php echo asset("images/".$val->getUser->img."")?>" width="17px;" class="img img-circle">
                        @endif
                        <?php $inc_member++;?>
                    @endforeach
                    @if($inc_member>=5)
                        {{$inc_member}}+
                    @endif
                </a>
            </div>

        </li>
