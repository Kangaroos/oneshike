

(function(window, document, $, DataTable) {

	/*
	 * Set the default display controller to be our bootstrap control
	 */
	DataTable.Editor.defaults.display = "bootstrap";

	$.extend(true, DataTable.Editor.defaults, {
		i18n: {
			create: {
				button: "新 建",
				submit: "保 存",
				title: "新建数据"
			},
			edit: {
				button: "修 改",
				submit: "保 存",
				title: "更新数据"
			},
			remove: {
				button: "删 除",
				submit: "确 定",
				confirm: {
					1: "您确定要删除这条数据？",
					_: "您确定要删除 %d 条数据"
				},
				title: "删除数据"
			}
		}
	});

	/*
	 * Alter the buttons that Editor adds to TableTools so they are suitable for bootstrap
	 */
	var tt = DataTable.TableTools;
	if ( tt ) {
		tt.BUTTONS.editor_create.formButtons[0].className = "btn btn-primary";
		tt.BUTTONS.editor_edit.formButtons[0].className = "btn btn-primary";
		tt.BUTTONS.editor_remove.formButtons[0].className = "btn btn-danger";
	}

	/*
	 * Change the default classes from Editor to be classes for Bootstrap
	 */
	$.extend( true, $.fn.dataTable.Editor.classes, {
		"header": {
			"wrapper": "DTE_Header modal-header"
		},
		"body": {
			"wrapper": "DTE_Body modal-body"
		},
		"footer": {
			"wrapper": "DTE_Footer modal-footer"
		},
		"form": {
			"tag": "form-horizontal"
		},
		"field": {
			"wrapper": "DTE_Field",
			"label":   "col-lg-4 control-label",
			"input":   "col-lg-8 controls",
			"error":   "error",
			"msg-labelInfo": "help-block",
			"msg-info":      "help-block",
			"msg-message":   "help-block",
			"msg-error":     "help-block"
		}
	} );


	/*
	 * Bootstrap display controller - this is effectively a proxy to the Bootstrap
	 * modal control.
	 */

	var self;

	DataTable.Editor.display.bootstrap = $.extend( true, {}, DataTable.Editor.models.displayController, {
		/*
		 * API methods
		 */
		"init": function ( dte ) {
			self._dom.content = $(
				'<div class="modal fade">'+
					'<div class="modal-dialog">'+
					'<div class="modal-content"/>'+
					'</div>'+
					'</div>'
			);
			self._dom.close = $('<button class="close">&times;</div>');

			self._dom.close.click( function () {
				self._dte.close('icon');
			} );

			$(document).on('click', 'div.modal-backdrop', function () {
				self._dte.close('background');
			} );

			dte.on( 'open.dtebs', function ( e, type ) {
				if ( type === 'inline' || type === 'bubble' ) {
					$('input[type=text], select', self._dom.form).addClass( 'form-control' );
				}
			} );

			return self;
		},

		"open": function ( dte, append, callback ) {
			if ( self._shown ) {
				if ( callback ) {
					callback();
				}
				return;
			}

			self._dte = dte;
			self._shown = true;

			var content = self._dom.content.find('div.modal-content');
			content.children().detach();
			content.append( append );

			$('div.modal-header', append).prepend( self._dom.close );

			$(self._dom.content)
				.one('shown', function () {
					if ( callback ) {
						callback();
					}
				})
				.one('hidden', function () {
					self._shown = false;
				})
				.modal( {
					"backdrop": "static"
				}
			);

			$('input[type=text], select', self._dom.content).addClass( 'form-control' );
		},

		"close": function ( dte, callback ) {
			if ( !self._shown ) {
				if ( callback ) {
					callback();
				}
				return;
			}

			$(self._dom.content).modal('hide');

			self._dte = dte;
			self._shown = false;

			if ( callback ) {
				callback();
			}
		},


		/*
		 * Private properties
		 */
		"_shown": false,
		"_dte": null,
		"_dom": {}
	} );

	self = DataTable.Editor.display.bootstrap;


}(window, document, jQuery, jQuery.fn.dataTable));