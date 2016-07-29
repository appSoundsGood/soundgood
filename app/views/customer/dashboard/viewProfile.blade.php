@extends('customer.layout')

@section('custom-styles')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    {{ HTML::style('/assets/css/demo.css') }}
    {{ HTML::style('/assets/css/home.css') }}    
    <style type="text/css">
    #pinBoot {
      position: relative;
      max-width: 100%;
      width: 100%;
    }
    img {
      width: 100%;
      max-width: 100%;
      height: auto;
    }
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
    </style>
@stop

@section('body')
<main class="bs-docs-masthead" role="main">
	
    <div class="background-dashboard" ></div>
	
    <div class="container">
         <div class="row">
			
            <?php if($followerId == $followingId){?>
			<div class="row text-center margin-top-normal margin-bottom-normal" style = "visibility:hidden;">
				<button type="button" class="btn btn-primary pull-right" onclick = "follow({{$followingId}})">Follow</button>
                <button type="button" class="btn btn-primary pull-right" onclick = "follow({{$followingId}})">Follow</button>
			</div> 
            <?php }else{?>
            <div class="row text-center margin-top-normal margin-bottom-normal" >
                <?php if($isFollow == "0"){?>
                    <button type="button" class="btn btn-primary pull-right" id = "followButton" onclick = "follow({{$followingId}})" style = "">Follow</button>
                    <button type="button" class="btn btn-primary pull-right" id = "unfollowButton" onclick = "unfollow({{$followingId}})" style = "display:none;">Unfollow</button> 
                <?php }else{?>
                    <button type="button" class="btn btn-primary pull-right" id = "followButton" onclick = "follow({{$followingId}})" style = "display:none;">Follow</button> 
                   <button type="button" class="btn btn-primary pull-right" id = "unfollowButton" onclick = "unfollow({{$followingId}})">Unfollow</button> 
                <?php }?>
                
                
            </div>     
            <?php } ?>
            <section id="pinBoot">
			  @foreach ($data as $key => $value)
              <article class="white-panel">
				<a href = "{{ URL::route('user.viewProfile', $value->user->id)  }}">
					<img style="width: 80px; height: 80px; border-radius: 5px;" src="{{ HTTP_PHOTO_PATH.$value->user->profile_image }}" >
				</a>
                <?php if($value->type == "post"){?>
                <div class="panel-heading"><a href="#" class="pull-right"></a> <h4>{{ $value->post->title}}</h4></div>
                <div class="panel-body">
                    {{ $value->post->content}}
                </div>
                <?php }else{?>
                <div class="panel-heading"><a href="#" class="pull-right"></a> <h4>{{ $value->recipe->name}}</h4></div>
                <div class="panel-body">
                    {{ $value->recipe->content}}

                </div>
                <?php if ( in_array( $value->recipe->id , $likes)){?>
                    <button type="button" class="btn btn-primary pull-right" onclick = "like({{$value->recipe->id}},{{$followingId}})" style = "display:none;" id = "likeButton{{$value->recipe->id}}">Like</button>
                    <button type="button" class="btn btn-primary pull-right"likeButton onclick = "unlike({{$value->recipe->id}},{{$followingId}})" id = "unlikeButton{{$value->recipe->id}}">Unlike</button>                
                <?php  }else{ ?>
                    <button type="button" class="btn btn-primary pull-right" onclick = "like({{$value->recipe->id}},{{$followingId}})" id = "likeButton{{$value->recipe->id}}">Like</button>
                    <button type="button" class="btn btn-primary pull-right" onclick = "unlike({{$value->recipe->id}},{{$followingId}})" style = "display:none;" id = "unlikeButton{{$value->recipe->id}}">Unlike</button>    
                 
                <?php  } ?>
                <?php } ?>

                
               
              </article>
              @endforeach
            </section>
            <hr>
          </div>
    </div> 
</main>
@stop
@section('custom-scripts')
@include('js.customer.follow');
<script type="text/javascript">
$(document).ready(function() {
$('#pinBoot').pinterest_grid({
no_columns: 4,
padding_x: 10,
padding_y: 10,
margin_bottom: 50,
single_column_breakpoint: 700
});
});
 $(document).ready(function() {

    $('#blog-landing').pinterest_grid({
        no_columns: 4
    });

});



;(function ($, window, document, undefined) {
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