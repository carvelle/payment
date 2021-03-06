webpackJsonp([11],{

/***/ 299:
/*!**********************************************************!*\
  !*** ./modules/MailSaveMessageAsPdfPlugin/js/manager.js ***!
  \**********************************************************/
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	module.exports = function (oAppData) {
		var
			$ = __webpack_require__(/*! jquery */ 1),
			
			TextUtils = __webpack_require__(/*! modules/CoreWebclient/js/utils/Text.js */ 43),
			UrlUtils = __webpack_require__(/*! modules/CoreWebclient/js/utils/Url.js */ 177),
			
			Ajax = __webpack_require__(/*! modules/CoreWebclient/js/Ajax.js */ 189),
			App = __webpack_require__(/*! modules/CoreWebclient/js/App.js */ 179),
			Screens = __webpack_require__(/*! modules/CoreWebclient/js/Screens.js */ 183)
		;
		
		if (App.getUserRole() === Enums.UserRole.NormalUser)
		{
			return {
				start: function (ModulesManager) {
					App.subscribeEvent('MailWebclient::AddMoreSectionCommand', function (fAddMoreSectionCommand) {
						fAddMoreSectionCommand({
							'Text': TextUtils.i18n('MAILSAVEMESSAGEASPDFPLUGIN/ACTION_DOWNLOAD_PDF'),
							'CssClass': 'pdf',
							'Handler': function () {
								if (this.currentMessage())
								{
									var
										oBody = this.currentMessage().getDomText(),
										fReplaceWithBase64 = function (oImg) {
											try
											{
												var
													oCanvas = document.createElement('canvas'),
													oCtx = null
												;

												oCanvas.width = oImg.width;
												oCanvas.height = oImg.height;

												oCtx = oCanvas.getContext('2d');
												oCtx.drawImage(oImg, 0, 0);

												oImg.src = oCanvas.toDataURL('image/png');
											}
											catch (e) {}
										}
									;

									$('img[data-x-src-cid]', oBody).each(function () {
										fReplaceWithBase64(this);
									});

									Ajax.send('MailSaveMessageAsPdfPlugin', 'GeneratePdfFile', {
										'FileName': this.subject(),
										'Html': oBody.html()
									}, function (oResponse) {
										if (oResponse.Result && oResponse.Result.Actions && oResponse.Result.Actions.download)
										{
											UrlUtils.downloadByUrl(oResponse.Result.Actions.download.url);
										}
										else if (oResponse.ErrorCode === Enums.Errors.LibraryNoFound)
										{
											Screens.showError(TextUtils.i18n('MAILSAVEMESSAGEASPDFPLUGIN/ERROR_NO_PDF_GENERATOR_FOUND'));
										}
										else
										{
											Screens.showError(TextUtils.i18n('MAILSAVEMESSAGEASPDFPLUGIN/ERROR_CREATING_PDF'));
										}
									}, this);
								}
							}
						});
					});
				}
			};
		}
		
		return null;
	};


/***/ })

});