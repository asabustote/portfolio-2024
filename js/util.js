//各操作に対し確認用のダイアログボックスを表示するメソッド
function confirmCRUDPrompt(crud) {
  var result = false;
  var msg    = "";

  if ('delete' === crud) {
    msg = "このユーザーを削除してもよろしいですか？";
  } else if('update' === crud) {
    msg = "このユーザーを更新してもよろしいですか？";
  } else if('add' === crud) {
    msg = "このユーザーを追加してもよろしいですか？";
  }

  result = confirm(msg)

  return result;
}