    <div class="padtop70">
        <div class="box_shadow">
            <div class="container-fluid w90">
                <div class="homehouse projecthome">
                    <div class="row">
                        <div class="col-12">
                            <h2>{!! BaseHelper::clean($title) !!}</h2>
                            @if ($description)
                            <p>{!! BaseHelper::clean($description) !!}</p>
                            @endif
                            @if ($subtitle)
                            <p>{!! BaseHelper::clean($subtitle) !!}</p>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="row rowm10 list-agency">
                        @foreach ($agents as $agent)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            {!! Theme::partial('real-estate.agents.item', ['account' => $agent]) !!}
                        </div>
                        @endforeach
                    </div> -->
                    <div style="position:relative;">
                        <div class="owl-carousel list-agency" id="agentslide">
                            @foreach ($agents as $agent)
                            <div class="item itemarea">
                                {!! Theme::partial('real-estate.agents.item', ['account' => $agent]) !!}
                            </div>
                            @endforeach
                        </div>
                        <i class="agent-am-next"><img src="{{ Theme::asset()->url('images/aright.png') }}" alt="pre"></i>
                        <i class="agent-am-prev"><img src="{{ Theme::asset()->url('images/aleft.png') }}" alt="next"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
