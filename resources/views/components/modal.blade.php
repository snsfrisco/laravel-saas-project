<div class="modal fade" id="{{$modalId}}">
    <div class="modal-dialog modal-{{$modalSize}}">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$title}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                @if($hasSubmitBtn)
                    <button type="button" class="btn btn-xs btn-primary float-left" id="{{$submitBtnId}}"

                    >
                        {{$submitBtnText}}
                    </button>
                @endif
                <button type="button" class="btn btn-xs btn-default float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
