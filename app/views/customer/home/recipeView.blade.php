
@extends('customer.layout')
@section('custom-styles')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    {{ HTML::style('/assets/css/demo.css') }}
    {{ HTML::style('/assets/css/home.css') }}
@stop
@section('body')
<main class="bs-docs-masthead" role="main" style="min-height: 0px;">
    <div class="col-sm-12" style="padding: 0px" >
        <div class="container search-box margin-bottom-sm">
            <div class="row">
                <div class = "col-sm-12">
                    <a>{{$data->name}}</a><br/>
                </div>
                <div class = "col-sm-12">
                    @foreach ($data->images as $value)
                         <img style="border-radius: 5px;" src="<?php echo($value->hostedLargeUrl);?>" >
                    @endforeach
                    <br/>
                </div>

                <div class = "col-sm-12">
                    <label>Ingredients::</label><br>
                    @foreach ($data->ingredientLines as $value)
                        - {{$value}}<br/>
                    @endforeach
                </div>
                <div class="col-sm-12">
                     <label>nutritionEstimates::</label><br>
                    @foreach ($data->nutritionEstimates as $value)
                        --{{$value->attribute}} 
                          {{$value->value}} cal <br/> 
                        
                    @endforeach
                </div>
                <div class="col-sm-12">
                     <label>flavors::</label><br>
                    <?php $keys = key($data->flavors);?>

                    @foreach ($data->flavors as $key=>$value)
                        - {{$key}}   {{$value}}<br/>                    
                        
                    @endforeach
                </div>
                <div class = "col-sm-12">
                    <label>totalTimeInSeconds::</label><br>
                    {{$data->totalTimeInSeconds/60}} mins
                </div>
            </div>
        </div>              
    </div>
</main>

<div class="gray-container">    
    <div class="container">
           <div class="row margin-top-xs" id="div_job">
                    <!-- Div for More -->
                    <div class="row" id="div_more" style="display: none;">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissibl fade in">
                                    <button type="button" class="close" data-target="div_more" onclick="hideView(this)">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <p>
                                        <span class="span-job-description-title">Similar Jobs:</span>
                                    </p>
                                    
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div_hint" style="display: none;">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissibl fade in">
                                    <button type="button" class="close" data-target="div_hint" onclick="hideView(this)">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <div class="row">
                                        <input type="hidden" name="is_name" id="is_name" value="">
                                        <input type="hidden" name="is_phonenumber" id="is_phonenumber" value="">
                                        <input type="hidden" name="is_email" id="is_email" value="">
                                        <input type="hidden" name="is_currentjob" id="is_currentjob" value="">
                                        <input type="hidden" name="is_previousjobs" id="is_previousjobs" value="">
                                        <input type="hidden" name="is_description" id="is_description" value="">
                                        
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-5 padding-top-xs text-right">
                                                    <span class="span-job-description-title">Name *:</span>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="name" type="text" id="name">
                                                </div>
                                            </div>
                                            <div class="row margin-top-xs">
                                                <div class="col-sm-5 padding-top-xs text-right">
                                                    <span class="span-job-description-title">Phonenumber *:</span>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="phone" type="text" id="phone">
                                                </div>
                                            </div>
                                            <div class="row margin-top-xs">
                                                <div class="col-sm-5 padding-top-xs text-right">
                                                    <span class="span-job-description-title">Email *:</span>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="email" type="text" id="email">
                                                </div>
                                            </div>
                                            <div class="row margin-top-xs">
                                                <div class="col-sm-5 padding-top-xs text-right">
                                                    <span class="span-job-description-title">Current Job *:</span>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="currentJob" type="text" id="currentJob">
                                                </div>
                                            </div>
                                            
                                            <div class="row margin-top-xs">
                                                <div class="col-sm-5 padding-top-xs text-right">
                                                    <span class="span-job-description-title">Previous jobs *:</span>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="previousJobs" type="text" id="previousJobs">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-sm-12 text-left">
                                                    <span class="span-job-description-title">Description *:</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" name="description" rows="3" id="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row margin-top-xs">
                                        <div class="col-sm-12 text-center">
                                            <div class="row margin-top-xs">
                                                <a class="btn btn-success btn-sm btn-home" style="padding: 5px 30px;" id="js-a-hint" data-id="">Submit</a>
                                            </div>  
                                        </div>
                                    </div>                                                  
                                </div>                              
                            </div>
                        </div>                  
                    </div>
                    <!-- End for Hint -->
                    
                    <!-- Div for Apply -->
                    <div class="row" id="div_apply" style="display: none;">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissibl fade in">
                                    <button type="button" class="close" data-target="div_apply" onclick="hideView(this)">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    
                                    <div class="row">
                                        <div class="col-sm-2 col-sm-offset-1">
                                        </div>
                                    </div>
                                    <div class="row margin-top-xs">
                                        <div class="col-sm-2 col-sm-offset-1">
                                            
                                        </div>
                                        <div class="col-sm-8">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="row margin-top-xs">
                                        <div class="col-sm-2 col-sm-offset-1">
                                            
                                        </div>
                                        <div class="col-sm-8">
                                            
                                        </div>
                                    </div>
                                    <div class="row margin-top-sm">
                                        <div class="col-sm-8 col-sm-offset-3 text-right">
                                            <div class="col-sm-4 col-sm-offset-8 text-right">
                                                <button class="btn btn-sm btn-primary text-uppercase btn-block" id="js-btn-apply" data-id="">SUBMIT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <!-- End for Apply -->
                </div>
            </div>
            <div class="pull-right"></div>
        </div>
    </div>
</div>
@stop
