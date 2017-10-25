$(function() {
   
   //menu
   //$('.menu-item-has-children a').append('<span class="caret"></span>');
   $('#menu_default li:has(a[href=#]) a').append('<span class="caret"></span>');
   $('.sub-menu .caret').hide();
   $('.sub-menu').addClass('dropdown-menu');
   
   //busca faq
   $('.panel-title a').addClass('collapsed');
   $('.busca .sf-field-search input[type=text], .duvida .sf-field-search input[type=text]').addClass('form-control input-busca');
   
   // abrir orçamento
   $(".btn-abrir").click(function(e){
	    e.preventDefault();
	    $('.box-orcamento').slideToggle("slow")
	});
   $(".bt_Close").click(function(e){
	    e.preventDefault();
	    $('.box-orcamento').slideToggle("slow")
	});
	
	//fixed	
/*
	if ( $(window).width() > 769) {
	    var offset = $(".produtos").offset();
	    var topPadding = 15;
	    $(window).scroll(function() {
	        if ($(window).scrollTop() > offset.top) {
	            $(".alig-r").stop().animate({
	                marginTop: $(window).scrollTop() - offset.top + topPadding
	            });
	        } else {
	            $(".alig-r").stop().animate({
	                marginTop: 0
	            });
	        };
	    });
	}	
*/
	
	//scroll
	$(".scroll").click(function(event){
		event.preventDefault();

		var full_url = this.href;

		var parts = full_url.split("#");
		var trgt = parts[1];

		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;

		$('html, body').animate({scrollTop:target_top}, 500);
	});
	
   //mask
	jQuery( function($){
		$(".data").mask("99/99/9999");
		$(".tel").mask("(99) 9999-9999");
		$(".cpf").mask("999.999.999-99");
		$(".cnpj").mask("99.999.999/9999-99");
	});
	
	//datapicker
	$(function() {
		$('#datepicker').datepicker({ 
			dateFormat: 'dd-mm-yy',
		    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		    nextText: 'Próximo',
		    prevText: 'Anterior',
		    startDate: new Date(),
			endDate: ''
  			}).on("show", function() {
  				$(this).val(new Date()).datepicker('update');
		});
 	});
	
	//carousel
	$('.carousel-banner').slick({
		infinite: true,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: false,
		fade: true,
		dots: true
	});

	$('.galeria-fotos').slick({
		infinite: true,
		speed: 1000,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: false,
		centerMode: true,
		variableWidth: true,
		slidesToShow: 4,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3
				    }
		  	},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	$('.galeria-produtos').slick({
		centerMode: true,
		infinite: true,
		speed: 1000,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: false,
		slidesToShow: 9,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 5
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 5
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2
				}
			}
		]
	});
	
	$('.galeria-parceiros').slick({
		infinite: true,
		speed: 1000,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: false,
		centerMode: false,
		variableWidth: false,
		slidesToShow: 6,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 4
				    }
		  	},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2
				}
			}
		]
	});
	
	$('.carousel-banner-prod').slick({
		infinite: true,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: false,
		fade: true,
		dots: true
	});
	
	// DEPOIMENTO
	$('.carousel-depoimento').slick({
		infinite: true,
		autoplaySpeed: 2000,
		arrows: false,
	dots: true
	});
   
   ///////////////////////////////
   //
   //  calculadora de bebidas
   //
   ///////////////////////////////
   
   
   //funcao que calcula
   function calculaBebida($pessoas, rate){
	   var resultado = {brut:0, moscatel:0, tinto:0, branco:0, whisky:0, vodka:0, cerveja:0, licor:0, energetico:0, energeticoPet:0, suco:0, sorvete:0, esp_Brinde:0, esp_Festainteira: 0, tequila: 0, destilados:0, cerveja_garrafa: 0, suco_Pet: 0};
	   
	   resultado['brut'] = 				Math.ceil($pessoas * rate['brut']);
	   resultado['moscatel'] = 			Math.ceil($pessoas * rate['moscatel']);
	   resultado['tinto'] = 			Math.ceil($pessoas * rate['tinto']);
	   resultado['branco'] = 			Math.ceil($pessoas * rate['branco']);
	   resultado['whisky'] = 			Math.ceil($pessoas * rate['whisky']);
	   resultado['vodka'] = 			Math.ceil($pessoas * rate['vodka']);
	   resultado['cerveja'] = 			Math.ceil($pessoas * rate['cerveja']);
	   resultado['licor'] = 			Math.ceil($pessoas * rate['licor']);
	   resultado['energetico'] = 		Math.ceil($pessoas * rate['energetico']);
	   resultado['energeticoPet'] = 	Math.ceil($pessoas * rate['energeticoPet']);
	   resultado['suco'] = 				Math.ceil($pessoas * rate['suco']);
	   resultado['sorvete'] = 			Math.ceil($pessoas * rate['sorvete']);
	   resultado['esp_Brinde'] = 		Math.ceil($pessoas * rate['esp_Brinde']);
	   resultado['esp_Festainteira'] = 	Math.ceil($pessoas * rate['esp_Festainteira']);
	   resultado['tequila'] = 			Math.ceil($pessoas * rate['tequila']);
	   resultado['destilados'] = 		Math.ceil($pessoas * rate['destilados']);
	   resultado['cerveja_garrafa'] = 	Math.ceil($pessoas * rate['cerveja_garrafa']);
	   resultado['suco_Pet'] = 			Math.ceil($pessoas * rate['suco_Pet']);
	   
	   return resultado;
	   
   }
   
   
   // click do botao calcular
   $('.btn-calcular').on('click', function(){
	   var rate = {brut:0.12, moscatel:0.22, tinto:0.15, branco:0.08, whisky:0.06, vodka:0.04, cerveja:1, licor:0.015, energetico:0.6, energeticoPet:0.15, suco:0.6, sorvete:0.5};
	   
	   resultado = calculaBebida($('.txt-pessoas').val(), rate);
	   
	   $('.brut .value').html(resultado['brut']);
	   $('.moscatel .value').html(resultado['moscatel']);
	   $('.tinto .value').html(resultado['tinto']);
	   $('.branco .value').html(resultado['branco']);
	   $('.whisky .value').html(resultado['whisky']);
	   $('.vodka .value').html(resultado['vodka']);
	   $('.cerveja .value').html(resultado['cerveja']);
	   $('.licor .value').html(resultado['licor']);
	   $('.energetico .value').html(resultado['energetico']);
	   $('.energeticoPet .value').html(resultado['energeticoPet']);
	   $('.suco .value').html(resultado['suco']);
	   $('.sorvete .value').html(resultado['sorvete']);

   });
   
    // click do botao calcular pra formatura
   $('.btn-calcular.formatura').on('click', function(){
	   var rate = {esp_Brinde:0.15, esp_Festainteira:0.33, whisky:0.15, vodka:0.15, tequila:0.1, destilados:0.1, cerveja_garrafa:1, cerveja:2, energetico:1.5, energeticoPet:0.3, suco:1, suco_Pet:0.4};
	   
	   resultado = calculaBebida($('.txt-pessoas').val(), rate);
	   $('.esp_Brinde .value').html(resultado['esp_Brinde']);
	   $('.esp_Festainteira .value').html(resultado['esp_Festainteira']);
	   $('.whisky .value').html(resultado['whisky']);
	   $('.vodka .value').html(resultado['vodka']);
	   $('.cerveja .value').html(resultado['cerveja']);
	   $('.cerveja_Gar .value').html(resultado['cerveja_garrafa']);
	   $('.destilados .value').html(resultado['destilados']);
	   $('.tequila .value').html(resultado['tequila']);
	   $('.energetico .value').html(resultado['energetico']);
	   $('.energeticoPet .value').html(resultado['energeticoPet']);
	   $('.suco .value').html(resultado['suco']);
	   $('.suco_Pet .value').html(resultado['suco_Pet']);

   });
   
   
   
	//////////////////////////////////////
	//
	//   carrinho
	//
	//////////////////////////////////////
	
	var carrinho = [];
	
	 if (localStorage['orcamento'] !== undefined ){
		carrinho = JSON.parse( localStorage['orcamento'] );
	}
	
	refreshCarrinho();

	
	
   
	$(document).on('click', '.btn-orcamento', function(e){
		e.preventDefault();
		
		$(this).prop("disabled",true);
		$(this).siblings('.select-orc').children('.qtde').prop("disabled", true);
		$(this).html('Adicionado');
		dados = $(this).data();
		produto = {
				id:dados['id'],
				nome:dados['nome'], 
				desc:dados['desc'], 
				premio:dados['premio'], 
				preco:dados['preco'], 
				qtde:$(this).siblings('.select-orc').children('.qtde').val(),
				max:$(this).siblings('.select-orc').children('.qtde').attr('data-max'),
				pic: dados['pic']
		};
		
		addProduto(produto);
	});
	
	$(document).on('click', '.remover-orc', function(e){
		e.preventDefault();
		removeProduto($(this).data('id'));
	});
	
	function removeProduto(id){
		carrinho = carrinho.filter(function (e) {
                        return e.id !== id;
					});
		$('.list-produtos .id-'+id + ' .btn-orcamento').prop("disabled",false);
		$('.list-produtos .id-'+id + ' .btn-orcamento').siblings('.select-orc').children('.qtde').prop("disabled", false);
		$('.list-produtos .id-'+id + ' .btn-orcamento').html('Adicionar ao orçamento');
		$('.list-produtos .id-'+id + ' .qtde').val('1');
			
		refreshCarrinho();
	}
   
   function addProduto(produto){
	if (localStorage['orcamento'] !== undefined){
	   carrinho = JSON.parse( localStorage['orcamento'] );
	}
	
	carrinho.push(produto);
	
	refreshCarrinho();
   }
   
   function refreshCarrinho(){
	   
	   localStorage['orcamento'] = JSON.stringify(carrinho);
	   
	   if(carrinho.length<1){
		   $('.form-final').hide();
			$('.qtde-total').html('Nenhum item adicionado ao orçamento');	   
	   }else if(carrinho.length<2){
		   	$('.form-final').show();
		   	$('.qtde-total').html(carrinho.length + ' item adicionado ao orçamento');
	   }else{
		   $('.form-final').show();
			$('.qtde-total').html(carrinho.length + ' itens adicionados ao orçamento');
	   }
	   var render = '';
		var ids =[];	
	   carrinho.forEach(function(item){
			id = item['id'];
			ids.push({id:item['id'], qtde:item['qtde']});
			qtde = item['qtde'];
			
			$('.list-produtos .id-'+id + ' .btn-orcamento').prop("disabled",true);
			$('.list-produtos .id-'+id + ' .btn-orcamento').siblings('.select-orc').children('.qtde').prop("disabled", true);
			$('.list-produtos .id-'+id + ' .btn-orcamento').html('Adicionado');
			$('.list-produtos .id-'+id + ' .qtde').val(qtde);
			
			render += '<div class="row id-'+item['id']+'"><div class="col-xs-12 col-sm-1 col-md-2 img-prod"> '+item['pic']+' </div><div class="col-xs-12 col-sm-6 col-md-4"><h2 class="name-prod">'+item['nome']+'</h2><div class="especifi"><p>'+item['desc']+'</p></div>';
			if (item['premio'] !== ''){
			   render += '<div class="premios"><p><strong>Premiações:</strong></p><p class="icon-premio">'+item['premio']+'</p></div>';
			}
			render += '<p class="preco">Preço médio: '+item['preco']+'</p></div><div class="col-xs-12 col-sm-3 col-md-3"><div class="select-orc">';
			render += '<select class="form-control qtde">';
			
			for (i = 1; i <= item['max']; i++){
				render += '<option>' + i + '</option>';
			}
			
			render += '</select>';
			render += '</div></div><div class="col-xs-12 col-sm-2 col-md-3"> <a class="remover-orc" data-id="'+item['id']+'" href="#">remover do orçamento</a> </div></div>';
	   });
	   
	   $()
	   
	   $('.box-orcamento .body-tabela').html(render);
	   
	   ids.forEach(function(item){
		   $('.box-orcamento .body-tabela .id-'+item['id']+' .qtde').val(item['qtde']);
	   });
	   
	   
   }
   
   $(document).on('click', '.enviar-orcamento', function(e){
	   
		e.preventDefault(); // if the clicked element is a link
		evento = '';
		if ($('#evento').is(':checked'))
			evento = 'Não necessito para evento';
		
		var data = { 'action':'emailAjax', 'tipo':'orcamento', 'nome':$('#nome').val(), 'email':$('#email').val(), 'telefone':$('#telefone').val(), 'msg':$('.msg textarea').val(),  'evento':evento, 'data':$('#data').val(), 'convidados':$('#convidados').val(), 'carrinho':carrinho };
		
		$('#nome').val('');
		$('#email').val('');
		$('#telefone').val('');
		$('.msg textarea').val('');
		$('#evento').prop('checked', false);
		$('#data').val('');
		$('#convidados').val('');
		
		//$('.box-orcamento .container .tabela').hide();
		$('.box-orcamento .tabela .body-tabela').html('');
		$('.box-orcamento .tabela').hide();
		$('.box-orcamento .form-final').hide();
		$('.box-orcamento .enviando').show();
		
		$.post(ajaxurl, data, function(response) {
		    limparCarrinho();
		    $('.box-orcamento .enviando').hide();
		    $('.box-orcamento .container .resposta').show();
		    setTimeout(function(){
				$('.box-orcamento .container .resposta').hide();
				$('.box-orcamento .tabela').show();
			}, 5000);
		    
		});

	});
	
	$(document).on('click', ".enviar-orcamento-email", function(e){
	   
		e.preventDefault(); // if the clicked element is a link
		$('#modalEnviar .formu').hide();
			$('#modalEnviar h2').html('Enviando...');
		
		var data = { 'action':'emailAjax', 'tipo':'orcamento_email', 'nome':$('#modalEnviar #nome').val(), 'email':$('#modalEnviar #email').val(), 'carrinho':carrinho };
		
		$.post(ajaxurl, data, function(response) {
			$('#modalEnviar h2').html('Enviado com sucesso.');
			
		    setTimeout(function(){
		    	$('#modalEnviar h2').html('Envie seu orçamento');
		    	$('#modalEnviar #nome').val('');
		    	$('#modalEnviar #email').val('');
				$('#modalEnviar .formu').show();
			}, 2000);
		    
		});

	});
	

	
	
	function limparCarrinho(){
		
		var ids =[];	
		carrinho.forEach(function(item){
			id = item['id'];
			ids.push({id:item['id']});
			
			$('.list-produtos .id-'+id + ' .btn-orcamento').prop("disabled",false);
			$('.list-produtos .id-'+id + ' .btn-orcamento').siblings('.select-orc').children('.qtde').prop("disabled", false);
			$('.list-produtos .id-'+id + ' .btn-orcamento').html('Adicionar ao orçamento');
			$('.list-produtos .id-'+id + ' .qtde').val('1');
		});
		
		$('.qtde-total').html('Nenhum item adicionado ao orçamento');
		
		localStorage.clear();
		carrinho = [];

	}
	
	
	//atualiza os produtos que já foram atualizados após o filtro de categoria
	
	$(document).on("sf:ajaxfinish", ".searchandfilter", function(){
		refreshCarrinho();
	});

	
	//imprimir/salvar orcamento
	$('.btn-imprimir').on('click', function(e){
		e.preventDefault();
		$('.box-orcamento .tabela').printThis();
	});
	
	
	//imprimir/salvar simulador
	$('.imprimir-calculo').on('click', function(e){
		e.preventDefault();
		$('#modalCalcular .modal-dialog').printThis();
	});
	
	//imprimir/salvar simulador eventos
	$('.imprimir-calculo-page').on('click', function(e){
		e.preventDefault();
		$('.cal-resultado .container').printThis();
	});
	
	//enviar calculo por email
		$(".enviar-calculo-email").on('click', function(e){
	   
		e.preventDefault(); // if the clicked element is a link
		$('#modalEnviarSidebar .formu').hide();
		$('#modalEnviarSidebar h2').html('Enviando...');
		
		var data = { 'action':'emailAjax', 'tipo':'calculo', 'nome':$('#modalEnviarSidebar #nome').val(), 'email':$('#modalEnviarSidebar #email').val(), 'resultado':$('.resultado-calculo').html() };
		
		$.post(ajaxurl, data, function(response) {
			$('#modalEnviarSidebar h2').html('Enviado com sucesso.');
			
		    setTimeout(function(){
		    	$('#modalEnviarSidebar h2').html('Envie seu orçamento');
		    	$('#modalEnviarSidebar #nome').val('');
		    	$('#modalEnviarSidebar #email').val('');
				$('#modalEnviarSidebar .formu').show();
			}, 2000);
		    
		});

	});
	
});


























