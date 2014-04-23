(function($){

	$('#save-generate-modal').on('hidden.bs.modal', function (e) {

		$('#save-input').show();
		$('#generate-report').hide();

	});

	$('#generate-report .choice li').click(function(){

		var _class = $(this).attr('class');

		if( _class=='no' ){

			$('#save-generate-modal').modal('hide');

		} else {
			
			$('#generate-report').slideToggle('slow');
			$('#email-address').slideToggle('slow');
			
		}

	});

	$('#content').on('click', '.bcontent p', function(){
		var _this = $(this),
			_id = _this.data('id'),
			_html = _this.html(),
			_data = { 'key': 'definition', 'value': _id },
			html = '<li data-id="'+_id+'">'+_html+'</li>';

		$().processSession( _data, 'addToSession' );

		$('#definition ul').append(html);
		_this.addClass('hide');

		$().arrowClick('up');

	});

	$('#content').on('dblclick', '#definition ul li', function(){
		var _this = $(this),
			_id = _this.data('id'),
			_data = { 'key': 'definition', 'value': _id };

		$().processSession( _data, 'removeFromSession' );

		$('.bcontent p').each(function(){
			var $this = $(this);

			if( _id == $this.data('id') ){
				$this.removeClass('hide');
			}
		});

		_this.remove();

	});
	
	$('#main-navi li').click(function(){
		var _liID = $(this).attr('id');

		$('#main-navi li').each(function(){
			var _curImg = $(this).find('img').attr('src'),
				_newImg = _curImg.replace('-active','-blur');

			$().deactiveTiles();
			$(this).find('img').attr('src',_newImg);
		});

		if( _liID == 'review' ){

			$( '.user' ).css({ 'margin-right':'55px' });
			$('.save-generate').show();

		}

		var _clickedNav = $(this).find('img').attr('src'),
			_activateNav = _clickedNav.replace('-blur','-active');

		$(this).find('img').attr('src',_activateNav);

		if( !$().mainChecker(_liID) || !$('.flipbox').hasClass('default') ){
			$().flipbox(_liID);
		}

		$().activateLogo(_liID);
		$().activateTiles(_liID);

	});

	$('.tiles li').click(function(){
		if( $(this).hasClass('activeTile') ){
			var _tileID = $(this).attr('id');
				$().flipbox(_tileID);
		} else {
			return false;	
		}	
	});

	$('#content').on('click', '#meter',function(){

		$('#measures').modal();

	});

	$('#content').on('click', '.otime', function(){
		var timeType = $(this).attr('id'),
			myModal = $('#myModal'),
			myVal = $(this).text();

		if( myVal != 0 ){
			$('select[name="minutes"] option', myModal).each(function(){
				if( $(this).val() == parseInt( myVal ) ){
					$(this).prop('selected','selected');	
				}
			});
		} else {
			$('select[name="minutes"] option:first', myModal).prop('selected','selected');
		}

		$('.modal-title span', myModal).text(timeType);

		myModal.modal();
	});

	$('#myModal .save-entry').click(function(){
		
		var selVal = $('select[name="minutes"]').val(),
			onoffset = $('#myModal .onoffset').text(),
			_data = { 'key': onoffset, 'value': selVal, 'single': true },
			myModal = $('#myModal');

		$('#'+onoffset+' span').text(selVal);

		$().processSession( _data, 'addToSession' );

		myModal.modal('hide');

		return false;
	});

	$('#measures .save-entry').click(function(){
		
		var selVal = $('#measures input[type="checkbox"]:checked'),
			_arr = [];

		selVal.each(function(i){
			_arr.push( $(this).val() );
		});

		var _data = { 'key': 'measure', 'value': _arr, 'clear': true };

		$().processSession( _data, 'addToSession' );

		$('#measures').modal('hide');
		return false;
	});

	$('.save-generate').click(function(){
		
		$('#save-generate-modal').modal();

		return false;
	});

	// $('.sfbutton').click(function(){
	// 	var _sfID = $(this).attr('id');

	// 	$().activateSFButton(_sfID);

	// });

	// $('.arrow').click(function(){
	// 	var _arID = $(this).attr('id');

	// 	$().arrowClick(_arID);

	// });

	$( '#content').on('click', '#definition', function(){
		$( 'ul', this ).toggle();
	});

	$('#content').on('click', '#outburst-behaviour', function(){
		var _class = $(this).attr('class'),
			_arID = ( _class == 'greyBg' ?  'down' : 'up' );

		$().arrowClick(_arID);		
	});

	$('.logo').click(function(){
		if( !$('.logo').hasClass('activate') ){
			return false;
		}
	});

}(jQuery));

jQuery.fn.extend({
	activateLogo: function(_liID){
		if( _liID == 'review'){
			$('.logo').addClass('activate').css('cursor','pointer');
		} else{
			$('.logo').removeClass('activate').css('cursor','default');
		}
	},
	activateTiles: function(_liID){
		var $liID = $('.'+_liID);

		$liID.each(function(){
			var _selTiles = $(this).find('img').attr('src'),
				_activateTiles = _selTiles.replace('-blur','-active');			

			$(this).addClass('activeTile').find('img').attr('src',_activateTiles);
		});
	},
	deactiveTiles: function(){
		$('.tiles').each(function(){
			$('li',this).each(function(){
				var _activeTiles = $(this).find('img').attr('src'),
					_deactivateTiles = _activeTiles.replace('-active','-blur');	

				$(this).removeClass('activeTile').find('img').attr('src',_deactivateTiles);
			});
		});
	},
	flipbox: function(_tileID){

		var $flipbox = $('.flipbox'),
			parentHeight = $flipbox.parent().height() - 20;
		
		$flipbox.attr('id',_tileID);
		$flipbox.flippy({
			color_target: $().boxBg(_tileID),
			duration: "500",
			verso: ( $('#'+_tileID).hasClass('close') ? $().getContent('close') : $().getContent(_tileID) ),
			onStart: function(){
				if( $().mainChecker(_tileID) ){
					$flipbox.addClass('default');
				} else {
					$flipbox.removeClass('default');
				}
			},
			onMidway: function(){
				if( !$flipbox.hasClass('default') ){
					$flipbox.css('height','419px');
				} else {
					$flipbox.css('height','384px');
				}
				
			},
			onFinish: function(){

				$('.boxes li').jScrollPane();
				$().contentClick();
				$().radioClick();

				$('.sfbutton').click(function(){
					var _sfID = $(this).attr('id');

					$().activateSFButton(_sfID);

				});

				$('.arrow').click(function(){
					var _arID = $(this).attr('id');

					$().arrowClick(_arID);

				});
			}
		});

	},
	mainChecker: function(_ID){
		return (_ID == 'manage' || _ID == 'understand' || _ID == 'describe' || _ID == 'review' ? true : false );
	},
	activateSFButton: function(_sfID){
		var $sf = $('#'+_sfID),
			_clickedNav = $sf.find('img').attr('src');

		if( $sf.hasClass('active') ){
			_activateNav = _clickedNav.replace('-active','-blur');
			$sf.removeClass('active');
		} else {
			_activateNav = _clickedNav.replace('-blur','-active');
			$sf.addClass('active');
		}

		$sf.find('img').attr('src',_activateNav);
	},
	getContent: function(_tileID){

		var data;

		$.ajax({
			url: global_url+'ajax/presentation',
			data: { tile: _tileID, plan_id: plan_id },
			type: 'POST',
			dataType: 'html',
			async: false,
			success: function(response){
				data = response;
			}
		});

		return data;

	},
	boxBg: function(_tileID){
		var boxBg = '';
		switch(_tileID){

			case 'pre-cursor-events':
				boxBg = '#ee7b4d';
			break;

			case 'post-cursor-events':
				boxBg = '#8aa6d6';
			break;

			case 'positive-reactive-strategies':
				boxBg = '#b56579';
			break;

			case 'control-strategies':
				boxBg = '#f47063';
			break;

			case 'other-reactive-strategies':
				boxBg = '#8580ba';
			break;

			case 'de-escalation-strategies':
				boxBg = '#699a81';
			break;

			case 'function':
				boxBg = '#cec74e';
			break;

			case 'consequences':
				boxBg = '#f4a55a';
			break;

			case 'trigger-events':
				boxBg = '#00746b';
			break;

			case 'calming-events':
				boxBg = '#3d5f8d';
			break;

			case 'escalating-events':
				boxBg = '#923e3c';
			break;

		}

		return boxBg;
	},
	contentClick: function(){
		$('.lists li span').bind( 'click', function(){
			var _parentID = $(this).parent().parent().parent().parent().attr('id'),
				_id = $(this).data('id'),
				_data = { 'key': _parentID, 'value': _id };

			if( $(this).hasClass('checked') ){
				$().processSession( _data, 'removeFromSession' );
				$(this).removeClass('checked');
			} else {
				$().processSession( _data, 'addToSession' );
				$(this).addClass('checked');
			}
		});
	},
	radioClick: function(){
		$('.radio li span').bind( 'click', function(){
			$('.radio li').each(function(){
				$(this).find('span').removeClass('checked');
			});
			$(this).addClass('checked');
		});
	},
	arrowClick: function(_arID){
		if( _arID == 'down'){
			$('#up').css('display','block');
			$('#outburst-behaviour').removeClass('greyBg').addClass('pinkBg');
			$('#outburst-behaviour hr').css({ 'display':'none' });
			$('#behaviour-label').css({ 'display':'block' });			
			$('.bcontent').jScrollPane();			
		} else {
			$('#down').css('display','block');
			$('#outburst-behaviour').removeClass('pinkBg').addClass('greyBg');
			$('#outburst-behaviour hr').css({ 'display':'block' });
			$('#behaviour-label').css({ 'display':'none' });			
		}
		$('#'+_arID+'.arrow').css('display','none');
	},
	processSession: function( _data, _function ){

		$.ajax({
			url: global_url+'ajax/'+_function,
			data: _data,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				console.log(response);
			},
			error: function(xhr, response, errorThrown){
				console.log(errorThrown);
			}
		});

	}, 
});