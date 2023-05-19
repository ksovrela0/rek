class kendoUI{
	loadKendoUI(url, action, itemPerPage, columnsCount, columnsSQL, gridName, actButtons, editType, columnNames, filtersCustomOperators, showOperatorsByColumns, selectorsForFilters, hidden='', filter=0, locked = '', lockable = '', freezeing_rows=0, pdfEnabled = false, excelEnabled = false, CampaignEnabled = false){
		this.ajaxURL = url;
		this.daction = action;
		this.itemPerPage = itemPerPage;
		this.columnsCount = columnsCount;
		this.columnsSQL = columnsSQL;
		this.gridName = gridName;
		this.actButtons = actButtons;
		this.editType = editType;
		this.hidden = hidden;
		this.freezeing_rows = freezeing_rows;
		this.pdfEnabled = pdfEnabled;
		this.excelEnabled = excelEnabled;
		this.CampaignEnabled = CampaignEnabled;
		
		if(filtersCustomOperators !== ''){
			this.customOperators = JSON.parse(filtersCustomOperators);
		}
		
		if(filter == 0){
			this.filterable = JSON.parse('{"mode": "row"}');
		}
		else{
			this.filterable = true;
		}

		//  LOADING COLUMNS AND MODELS BEGIN
		this.getColumnsURL = this.ajaxURL+"?act=get_columns&count="+this.columnsCount;
		var self = this;
		$.ajax({
			url: this.getColumnsURL,
			data: {cols: columnsSQL, names: columnNames, operators: showOperatorsByColumns, selectors: selectorsForFilters, locked: locked, lockable: lockable},
			dataType: "json",
			success: function(kendoData) {
				self.generateGrid(kendoData);
			}
		});


		
		// LOADING COLUMNS AND MODELS END
	}

	generateGrid(kendoData){
		this.dataSource = new kendo.data.DataSource({
			transport: {
				read:  {
					url: this.ajaxURL + "?act="+this.daction+"&count="+this.columnsCount+"&cols="+this.columnsSQL+this.hidden,
					dataType: "json"
				},
				update: {
					url: this.ajaxURL + "?act=save_priority",
					dataType: "json"
				},
				destroy: {
					url: this.ajaxURL + "?act=disable",
					dataType: "json"
				},
				create: {
					url: this.ajaxURL + "/Products/Create",
					dataType: "json"
				},
				
				parameterMap: function(data, options, operation) {
					
					if (operation !== "read" && options.models) {
						return {models: kendo.stringify(options.models)};
					}
					else {
						return {add: kendo.stringify(data)};
					}
				}
			},
			batch: true,
			pageSize: this.itemPerPage,
			
			schema: {
				model: kendoData.modelss,
				total: 'total',
				data: function (data) {
					return data.data;
				}
			},
			/* serverPaging: false, */
			serverFiltering: false,
			
		});
		
		$("#"+this.gridName).empty();

		var self = this;
		var onDataBound = (arg) => { 

			if(this.gridName == 'product_categories'){
				var total = 0;
				$("#product_categories tr[role='row'] td:nth-child(6)").each(function(i, x){

					var uid = $(x).parent().attr('data-uid');

					var type = $("#product_categories tr[data-uid='"+uid+"'] td:nth-child(9)").html();

					console.log(type)

					if(parseInt($(x).html()) <= 0 && type != 'ათხოდი'){
						$(x).parent().css("background-color","rgb(255 0 0 / 15%)")
					}
					if(parseInt($(x).html()) <= 10 && parseInt($(x).html()) > 0 && type != 'ათხოდი'){
						$(x).parent().css("background-color","rgb(251 255 0 / 15%)")
					}
					total += parseInt($(x).html());
				})
				$("#total_glass").html(total);
			}

			else if(this.gridName == 'product_div'){
				var total_minapaket = 0;
				var total_laqmeqs = 0;
				var total_dush = 0;
				var total_mina = 0;
				$("#product_div tr[role='row'] td:nth-child(2)").each(function(i, x){

					if($(x).html() == 'მინაპაკეტი'){
						total_minapaket++;
					}
					if($(x).html() == 'ლამექსი'){
						total_laqmeqs++;
					}
					if($(x).html() == 'დუშკაბინა'){
						total_dush++;
					}
					if($(x).html() == 'მინა'){
						total_mina++;
					}
				})


				$("#minapaket_cc").html(total_minapaket);
				$("#lameqs_cc").html(total_laqmeqs);
				$("#dush_cc").html(total_dush);
				$("#mina_cc").html(total_mina);

				
			}

			else if(this.gridName == 'main_div'){
				let total_to_pay = 0;
				let total_avans = 0;
				let total_zedm = 0;
				let total_have_to_pay = 0;
				$("#main_div tr[role='row'] td:nth-child(8)").each(function(i, x){
					total_to_pay += parseFloat($(x).html());
					$("#main_div .k-filter-row th:nth-child(8)").html(total_to_pay)
				});

				$("#main_div tr[role='row'] td:nth-child(9)").each(function(i, x){
					total_avans += parseFloat($(x).html());
					$("#main_div .k-filter-row th:nth-child(9)").html(total_avans)
				});

				$("#main_div tr[role='row'] td:nth-child(10)").each(function(i, x){
					total_zedm += parseFloat($(x).html());
					$("#main_div .k-filter-row th:nth-child(10)").html(total_zedm)
				});

				$("#main_div tr[role='row'] td:nth-child(11)").each(function(i, x){
					total_have_to_pay += parseFloat($(x).html());
					$("#main_div .k-filter-row th:nth-child(11)").html(total_have_to_pay)
				});
				$(".f_img").fancybox();
			}
		}

		var freeze = function (e){
			e.sender.element.find(".customHeaderRowStyles").remove();
            var items = e.sender.items();
            e.sender.element.height(e.sender.options.height);   
            items.each(function(){
              var row = $(this);
              var dataItem = e.sender.dataItem(row);
              if(dataItem.id2 == '<img style="margin-bottom: 3px;" src="media/images/icons/star.png">'){
                  var item = row.clone();                
                  item.addClass("customHeaderRowStyles");
                  var thead = e.sender.element.find(".k-grid-header table thead");
                  thead.append(item);
                    e.sender.element.height(e.sender.element.height() + row.height());                
                  row.hide();
              }
			});
			
		}


		var customTools = [];
		var AddInCampaignButton = '<a id="select_campaign" role="button" class="k-button k-button-icontext k-grid-dictionary-add"><span class="k-icon k-i-dictionary-add"></span> კამპანიაში დამატება</a>';
		
		if(this.CampaignEnabled){
			customTools.push({ 	template: AddInCampaignButton	});
		}
		if(this.actButtons != ''){
			customTools.push({	template: this.actButtons	});
		}
		if(this.pdfEnabled){
			customTools.push({ 	name: "pdf"	 })
		}
		if(this.excelEnabled){
			customTools.push({	name: "excel"	})
		}
	
		if(this.freezeing_rows == 0){
			$("#"+this.gridName).kendoGrid({
				toolbar: customTools,
				pdf: {
					allPages: true,
					avoidLinks: true,
					paperSize: "A4",
					margin: { top: "2cm", left: "1cm", right: "1cm", bottom: "1cm" },
					landscape: true,
					repeatHeaders: true,
					template: $("#page-template").html(),
					scale: 0.8
				},
				dataSource: this.dataSource,
				selectable: "multiple",
				allowCopy: true,
				persistSelection: true,
				//height: 350,
				sortable: true,
				filterable: {
					mode: "menu, row",
					operators: {
						string: {
							contains: "Contains",
							suggestionOperator: "contains"
						}
					},
					itemTemplate: function(e) {
						if (e.field == "all") {
							//handle the check-all checkbox templat

							return '<li class="k-item k-check-all-wrap"><label class="k-label k-checkbox-label"><input type="checkbox" class="k-checkbox k-checkbox-md k-rounded-md k-check-all" value="Select All"><span>#= all#</span></label></li>';
						} else {
							//handle the other checkboxes
							console.log(e)
							
							return "<li class='k-item'><label class='k-label k-checkbox-label'><input type='checkbox' class='k-checkbox k-checkbox-md k-rounded-md' value='#="+e.field+"#'><span>#="+e.field+"#</span></label></li>"
						}
					}
				},
				pageable: {
					refresh: true,
					pageSizes: true,
					position: "top",
					buttonCount: 5
				},
				// toolbar: this.actButtons,
				columns: kendoData.columnss,
				editable: this.editType,
				dataBound: onDataBound
			});
		}
		else{
			$("#"+this.gridName).kendoGrid({
				toolbar: customTools,
				pdf: {
					allPages: true,
					avoidLinks: true,
					paperSize: "A4",
					margin: { top: "2cm", left: "1cm", right: "1cm", bottom: "1cm" },
					landscape: true,
					repeatHeaders: true,
					template: $("#page-template").html(),
					scale: 0.8
				},
				dataSource: this.dataSource,
				selectable: "multiple",
				allowCopy: true,
				persistSelection: true,
				height: 400,
				sortable: true,
				filterable: true,
				pageable: {
					refresh: true,
					pageSizes: true,
					position: "top",
					buttonCount: 5
				},
				columns: kendoData.columnss,
				editable: this.editType,
				
				dataBound: freeze
			});
		}
		
	}
		
	getStatus(KendoisLoaded, gridName){
		if(gridName == "project_table"){ // დროებითია
			excel_upload()
		}

		// var grid = $("#"+gridName).data("kendoGrid");
		// grid.hideColumn(0);
  
		// $("#"+gridName).kendoTooltip({  
		//   show: function(e){  
		// 	  if(this.content.text().length > 10){  
		// 	  this.content.parent().css("visibility", "visible");  
		// 	  }  
		//   },  
		//   hide:function(e){  
		// 	  this.content.parent().css("visibility", "hidden");  
		//   },  
		//   filter: "td", 
		//   position: "right",  
		//   content: function(e){  
		// 	  var content = e.target[0].innerText;  
		// 	  return content;  
		//   }  
		//   }).data("kendoTooltip");

		console.log(KendoisLoaded, gridName)
	}
	kendoSelectorByClass(selectorName, url, action, title, preSelected = ''){
		$("."+selectorName).kendoDropDownList({
			serverFiltering: true,
			//filter: true,
			dataSource:  new kendo.data.DataSource({
				transport: {
					read: {
						url: url + "?act="+ action,
						dataType: "json"
					}
				},
				schema: {
					total: 'total',
					data: function (data) {
						var addCustomObject = {"id": "", "name": title}
						data = data.result;

						if( data != null){
							var data = [addCustomObject].concat(data);
							data.slice = () => JSON.parse(JSON.stringify(data));
						}else{
							data = {"id": "", "name": title};
							var data = [].concat(data);
							data.slice = () => JSON.parse(JSON.stringify(data));
						}
						return data;
					}
				},
			}),
			// filter: "startswith",
			value: preSelected,
			dataTextField: "name",
			dataValueField: "id"
		});
	}
	kendoSelector(selectorName, url, action, title, preSelected = ''){
		$("#"+selectorName).kendoDropDownList({
			serverFiltering: true,
			//filter: true,
			dataSource:  new kendo.data.DataSource({
				transport: {
					read: {
						url: url + "?act="+ action,
						dataType: "json"
					}
				},
				schema: {
					total: 'total',
					data: function (data) {
						var addCustomObject = {"id": "", "name": title}
						data = data.result;

						if( data != null){
							var data = [addCustomObject].concat(data);
							data.slice = () => JSON.parse(JSON.stringify(data));
						}else{
							data = {"id": "", "name": title};
							var data = [].concat(data);
							data.slice = () => JSON.parse(JSON.stringify(data));
						}
						return data;
					}
				},
			}),
			// filter: "startswith",
			value: preSelected,
			dataTextField: "name",
			dataValueField: "id"
		});
	}

	kendoMultiSelector(selectorName, url, action, title){
		$("#"+selectorName).kendoMultiSelect({
			
			placeholder: title,
			dataTextField: "name",
			dataValueField: "id",
			headerTemplate: '<div class="dropdown-header k-widget k-header">' +
					'<span></span>' +
					'<span></span>' +
				'</div>',
			footerTemplate: '',
			itemTemplate: '<span class="k-state-default" style="font-size: 13px">#: data.name #</span>',
			tagTemplate:  '<span>#:data.name#</span>',
			dataSource: new kendo.data.DataSource({
				transport: {
					read: {
						dataType: "json",
						url: url +"?act=" + action,
					}
				},
				schema: {
					data: (res) => {
						res = res.result;
						res.slice = () => JSON.parse(JSON.stringify(res));
						return res;
					}
				}
			}),
			height: 300
		});
	}

}

