/**
 * Created by Janet on 28/02/2016.
 */
window.onload = function()
{
    var sendCommentField = document.getElementById("inputPostComment");
    sendCommentField.onkeypress = function(e){
        //console.log(commentField.value);
        if(e.keyCode == 13){
            var postId = document.getElementById("postIdField").value;
            var message = sendCommentField.value;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    var uName = document.getElementById("uName").value;
                    var commentsField = document.getElementById("commentsField");
                    var response = xmlhttp.responseText;
                    if(response){
                        var sendCommentFieldBackup = sendCommentField;
                        commentsField.removeChild(sendCommentField);
                        var node = document.createElement("span");
                        var textnode = document.createTextNode(uName+" says:");
                        node.appendChild(textnode);
                        commentsField.appendChild(node);

                        node = document.createElement("p");
                        textnode = document.createTextNode(message);
                        node.appendChild(textnode);
                        commentsField.appendChild(node);
                        sendCommentFieldBackup.value = '';
                        commentsField.appendChild(sendCommentFieldBackup);

                    }else {
                        console.log("No se ha podido comentar");
                    }
                    //con responseText añadir bloque con comentario recien enviado al recibir true
                /*<span>'.$currentComment['from']['name'].' says: </span>';
                    echo '<p>'.$currentComment['message'].'</p>';*/
                }
            };
            xmlhttp.open("GET", "postComment.php?postId=" + postId + "&message=" + message, true);
            xmlhttp.send();
            console.log();
        }
    }
}