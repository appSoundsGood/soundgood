@extends('customer.layout')

@section('custom-styles')
    <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">{{ HTML::style('/assets/css/demo.css') }}
    {{ HTML::style('/assets/css/home.css') }} 
     -->
    <style type="text/css">
    
    #pinBoot {
      position: relative;
      max-width: 100%;
      width: 100%;
    }
    /* img {
      width: 100%;
      max-width: 100%;
      height: auto;
    } */
    .white-panel {
      position: absolute;
      background: white;
      box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
      padding: 10px;
    }
    .white-panel h1 {
      font-size: 1em;
    }
    .white-panel h1 a {
      color: #A92733;
    }
    .white-panel:hover {
      box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
      margin-top: -5px;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
    }
    
    .ninja input {
    	padding: 0 10px 0 30px;
    }
    
    .keywords {
    	position: relative;
    	max-width: 240px;
    }
    .keywords button {
    	position: absolute;
    	top: 3px;
    	bottom: 3px;
    	left: 6px;
    	right: auto;
    	background: none;
    	border: none;
    	z-index: 3;
    }
    
    </style>
@stop

@section('content')
<main class="bs-docs-masthead gray-container" role="main">
    <div class="background-dashboard" style="z-index: 0;"></div>
    <div class="container">
    	<div class="row">
            <div class="col-sm-1">
            </div>
            <form action = "{{ URL::route('customer.home')}}" method = "get">
            <div class="col-sm-11">
                <!-- <div class="row">
                    <div class="pull-right">
                        <select class="selectpicker form-control" name = "recipe" id = "recipeFilter" onChange = "searchRecipe();">
                          <option>Filter</option>
                          <option value = "maze">Maze</option>
                          <option value = "salad">Salad</option>
                          <option value = "soup">Soup</option>
                        </select>
                    </div>
                </div>
                <button id = "recipeButton" type = "submit" style = "display:none;"></button> -->
                <div class="keywords pull-right">
                	<span class="ninja">
                		<input type="text" class="form-control" name="q" id="recipe-q" placeholder="Search recipes...">                		
                	</span>
                	<button type="submit" class="search-button">
                		<i class="fa fa-search"></i>
                	</button>
                </div>
            </div>
            </form>
        </div>
         <div class="row">
			<hr>
            <section id="pinBoot">
			  @foreach ($data as $key => $value)
              <article class="recipe white-panel">
                  <a href = "{{ URL::route('customer.viewRecipe', [$value->id, base64_encode($value->spoonacularSourceUrl)]) }}"> 
                   <img style = "width:180px;height:120px;" src="{{$value->image}}" >
                  </a><br/>
                  
                 <a class = "" href = "{{ URL::route('customer.viewRecipe', [$value->id, base64_encode($value->sourceUrl)]) }}">{{$value->title}}</a><br/>
                 <div class="panel-heading"><a href="#" class="pull-right"></a> <h4></h4></div>
                 <div class="panel-body">                                       
                    <?php if (isset($value->sourceName)) {
                    	echo 'Source : '. $value->sourceName. '<br/>';
                    }
                    ?>
                    TotalTime : {{$value->readyInMinutes}} min <br/>
                    Rating : {{$value->weightWatcherSmartPoints}} 
                </div>
                <div class="panel-group" id="accordion{{$key}}">
                	<?php if (isset($value->missedIngredients) && count($value->missedIngredients) > 0) { ?>
					<div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion{{$key}}" href="#collapseTwo{{$key}}">Missed Ingredients</a>
                            </h4>
                        </div>
                        <div id="collapseTwo{{$key}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                @foreach ($value->missedIngredients as $t)
                                <div style="margin-bottom: 5px">
                                    - {{ $t->name }} 
                                    <button type="button" class="btn btn-xs btn-info" onclick="addIngredientToList('{{ $t->name }}')"><i class="fa fa-cart-plus"></i> Add</button><br/>
                                </div>
                                @endforeach                               
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion{{$key}}" href="#collapseOne{{$key}}">Ingredients</a>
                            </h4>
                        </div>
                        <div id="collapseOne{{$key}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                 @foreach ($value->extendedIngredients as $value1)
                                    - {{$value1->name}}<br/>
                                @endforeach
                               
                            </div>
                        </div>
                    </div>
                    <?php if(isset($value->flavor)){?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion{{$key}}" href="#collapseThree{{$key}}">flavors</a>
                            </h4>
                        </div>
                        <div id="collapseThree{{$key}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php $keys = key($value->flavors);?>

                                @foreach ($value->flavors as $key3=>$value3)
                                    - {{$key3}}   {{$value3}}<br/>                    
                                    
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>   
                <div class="panel-body like-panel">
                	<span class="likes">{{$value->likes}} likes</span>
                	<div class="pull-right">
                		<button type="button" class="btn btn-sm btn-success" onclick="likeRecipe('{{ $userId}}', '{{$value->id}}', this)">Like</button>
                	</div>
                </div>
              </article>
              @endforeach
            </section>
            <hr>
          </div>
          <p>
          </p>
      
    </div> 
</main>
@stop

@section('custom-scripts')
<script type="text/javascript">
function searchRecipe(){
	var recipeName = $("#recipeFilter").val();
	if(recipeName != ""){
		$("#recipeButton").click();
	}
}
	
function likeRecipe(userId , recipeId, button_object){
  $.ajax({
      url: "<?php echo URL::route('customer.likeRecipe'); ?>",
      dataType: "json",
      type: "POST",
      data: { 
      	userId : userId ,
        recipeId : recipeId 
      },
      success : function(data) {
          if (data.result == 'success') {
              var article = $(button_object).parents('.recipe');
              article.find('.like-panel .likes').html(data.likes + ' likes');
          }
      }
   });
}

function unlikeRecipe(userId , recipeId){
  $.ajax({
     url: "<?php echo URL::route('customer.unlikeRecipe'); ?>",
     dataType: "json",
     type: "POST",
     data: { 
      	userId : userId ,
        recipeId : recipeId 
     },
     success : function(data) {
    	 if (data.result == 'success') {
             var article = $(button_object).parents('.recipe');
             article.find('.like-panel .likes').html(data.likes + ' likes');
         }      
     }
   });
}

function addIngredientToList(ingredient) {
	$.ajax({
		type: 'POST',
		url: '<?php echo URL::route('customer.addIngredientToList'); ?>',
		data: {
			'ingredient': ingredient
		},
		dataType: 'json',
		success: function(data) {
			if (data.result != 'success') {
				alert("This product is not available in the store.");
			}
		},
		error: function(error) {
			alert("Failed to add product to the shopping list.");
			console.log(error);
		}
	});
}
	
$(document).ready(function() {
	$('#pinBoot').pinterest_grid({
		no_columns: 4,
		padding_x: 10,
		padding_y: 10,
		margin_bottom: 50,
		single_column_breakpoint: 700
	});

	$('#blog-landing').pinterest_grid({
        no_columns: 4
    });
});

(function ($, window, document, undefined) {
    var pluginName = 'pinterest_grid',
        defaults = {
            padding_x: 10,
            padding_y: 10,
            no_columns: 3,
            margin_bottom: 50,
            single_column_breakpoint: 700
        },
        columns,
        $article,
        article_width;

    function Plugin(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options) ;
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype.init = function () {
        var self = this,
            resize_finish;

        $(window).resize(function() {
            clearTimeout(resize_finish);
            resize_finish = setTimeout( function () {
                self.make_layout_change(self);
            }, 11);
        });

        self.make_layout_change(self);

        setTimeout(function() {
            $(window).resize();
        }, 500);
    };

    Plugin.prototype.calculate = function (single_column_mode) {
        var self = this,
            tallest = 0,
            row = 0,
            $container = $(this.element),
            container_width = $container.width();
            $article = $(this.element).children();

        if(single_column_mode === true) {
            article_width = $container.width() - self.options.padding_x;
        } else {
            article_width = ($container.width() - self.options.padding_x * self.options.no_columns) / self.options.no_columns;
        }

        $article.each(function() {
            $(this).css('width', article_width);
        });

        columns = self.options.no_columns;

        $article.each(function(index) {
            var current_column,
                left_out = 0,
                top = 0,
                $this = $(this),
                prevAll = $this.prevAll(),
                tallest = 0;

            if(single_column_mode === false) {
                current_column = (index % columns);
            } else {
                current_column = 0;
            }

            for(var t = 0; t < columns; t++) {
                $this.removeClass('c'+t);
            }

            if(index % columns === 0) {
                row++;
            }

            $this.addClass('c' + current_column);
            $this.addClass('r' + row);

            prevAll.each(function(index) {
                if($(this).hasClass('c' + current_column)) {
                    top += $(this).outerHeight() + self.options.padding_y;
                }
            });

            if(single_column_mode === true) {
                left_out = 0;
            } else {
                left_out = (index % columns) * (article_width + self.options.padding_x);
            }

            $this.css({
                'left': left_out,
                'top' : top
            });
        });

        this.tallest($container);
        $(window).resize();
    };

    Plugin.prototype.tallest = function (_container) {
        var column_heights = [],
            largest = 0;

        for(var z = 0; z < columns; z++) {
            var temp_height = 0;
            _container.find('.c'+z).each(function() {
                temp_height += $(this).outerHeight();
            });
            column_heights[z] = temp_height;
        }

        largest = Math.max.apply(Math, column_heights);
        _container.css('height', largest + (this.options.padding_y + this.options.margin_bottom));
    };

    Plugin.prototype.make_layout_change = function (_self) {
        if($(window).width() < _self.options.single_column_breakpoint) {
            _self.calculate(true);
        } else {
            _self.calculate(false);
        }
    };

    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new Plugin(this, options));
            }
        });
    }

})(jQuery, window, document);
</script>
@stop