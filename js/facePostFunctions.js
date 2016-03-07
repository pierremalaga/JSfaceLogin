/*
 * Created by Janet on 28/02/2016.
 */
window.onload = function()
{
    /*var sendCommentField = document.getElementById("inputPostComment");
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
                <span>'.$currentComment['from']['name'].' says: </span>';
                    echo '<p>'.$currentComment['message'].'</p>';
                }
            };
            xmlhttp.open("GET", "postComment.php?postId=" + postId + "&message=" + message, true);
            xmlhttp.send();
            console.log();
        }
    }

    /*var sendPostField = document.getElementById()
    sendPostField.onkeypress = function(e){
        if(e.keyCode == 13) {

        }
    }
     */
}
function sendComment(elem) {

    console.log(elem);
    elem.onkeypress = function(e){

        if(e.keyCode == 13) {
            //var sendCommentField = document.getElementById("inputPostComment");
            var sendCommentField = elem;
            var postId = elem.name;
            var message = sendCommentField.value;
            console.log(postId);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    var uName = document.getElementById("uName").value;
                    var commentsField = document.getElementById("commentsField_"+postId);
                    var response = xmlhttp.responseText;

                    if (response) {
                        var sendCommentFieldBackup = sendCommentField;
                        var sendButton = document.getElementById("sendPostComment_"+postId);
                        commentsField.removeChild(sendCommentField);
                        commentsField.removeChild(sendButton);
                        var node = document.createElement("span");
                        var textnode = document.createTextNode(uName + " says:");
                        node.appendChild(textnode);
                        commentsField.appendChild(node);

                        node = document.createElement("p");
                        textnode = document.createTextNode(message);
                        node.appendChild(textnode);
                        commentsField.appendChild(node);
                        sendCommentFieldBackup.value = '';
                        commentsField.appendChild(sendCommentFieldBackup);
                        commentsField.appendChild(sendButton);

                    } else {
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
function sendCommentByClick(elem){
    console.log("->"+elem);
    var sendCommentField = elem;
    var message = sendCommentField.value;
    var postId = sendCommentField.name;
    console.log(postId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            var uName = document.getElementById("uName").value;
            var commentsField = document.getElementById("commentsField_"+postId);
            var response = xmlhttp.responseText;

            if (response) {
                var sendCommentFieldBackup = sendCommentField;
                var sendButton = document.getElementById("sendPostComment_"+postId);
                commentsField.removeChild(sendCommentField);
                commentsField.removeChild(sendButton);
                var container = document.createElement("div");
                container.className = "singleCommentBox";

                var node = document.createElement("span");
                var textnode = document.createTextNode(uName + " says:");
                node.appendChild(textnode);
                container.appendChild(node);

                node = document.createElement("p");
                textnode = document.createTextNode(message);
                node.appendChild(textnode);
                container.appendChild(node);
                commentsField.appendChild(container);
                sendCommentFieldBackup.value = '';

                commentsField.appendChild(sendCommentFieldBackup);
                commentsField.appendChild(sendButton);




            } else {
                console.log("No se ha podido comentar");
            }
            //con responseText añadir bloque con comentario recien enviado al recibir true
            /*<span>'.$currentComment['from']['name'].' says: </span>';
             echo '<p>'.$currentComment['message'].'</p>';*/
        }
    };
    xmlhttp.open("GET", "postComment.php?postId=" + postId +"&message=" + message, true);
    xmlhttp.send();
    console.log();
}
function sendPostByClick(elem){

    var messagePost = elem.value;
    console.log(elem.value);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        console.log(xmlhttp.readyState);
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            var uName = document.getElementById("uName").value;

            var response = xmlhttp.responseText;
            console.log("Respuesta");
            console.log(response);
            /*var decodingResponse = response.split(":");
            console.log(decodingResponse);
            var responseConf = decodingResponse[0];
            var postId = decodingResponse[1];
            console.log(responseConf);
            console.log(postId);*/
            if (response) {
                var section = document.createElement("section");
                section.className = "socialBox";

                section.innerHTML = response;
                var list = document.getElementById("main_content");
                list.insertBefore(section, list.childNodes[2]);
                /*var sendCommentFieldBackup = sendCommentField;
                var sendButton = document.getElementById("sendPostComment_"+postId);
                commentsField.removeChild(sendCommentField);
                commentsField.removeChild(sendButton);
                var container = document.createElement("div");
                container.className = "singleCommentBox";

                var node = document.createElement("span");
                var textnode = document.createTextNode(uName + " says:");
                node.appendChild(textnode);
                container.appendChild(node);

                node = document.createElement("p");
                textnode = document.createTextNode(message);
                node.appendChild(textnode);
                container.appendChild(node);
                commentsField.appendChild(container);
                sendCommentFieldBackup.value = '';

                commentsField.appendChild(sendCommentFieldBackup);
                commentsField.appendChild(sendButton);
                var newItem = document.createElement("LI");
                var textnode = document.createTextNode("Water");
                newItem.appendChild(textnode);

                var list = document.getElementById("myList");
                list.insertBefore(newItem, list.childNodes[2]);*/
                /*var section = document.createElement("section");
                section.clasName = "socialBox";

                var inputId = document.createElement("input");
                inputId.type = "hidden";
                inputId.value = postId;
                inputId.id = "postIdField";
                var publicationCard = document.createElement("div");
                publicationCard.className = "publicationCard";
                var firstRow = document.createElement("div");
                firstRow.className = "firstRow";
                var upictPublication = document.createElement("img");
                upictPublication.className = "upictPublication";
                var uname = document.createElement("p");
                uname.clasName = "uname";
                var subInfo = document.createElement("span");
                subInfo.className = "subInfo";*/



            } else {
                console.log("No se ha podido comentar");
            }
            //con responseText añadir bloque con comentario recien enviado al recibir true
            /*<span>'.$currentComment['from']['name'].' says: </span>';
             echo '<p>'.$currentComment['message'].'</p>';*/
        }

    };
    xmlhttp.open("GET", "sendPost.php?message=" + messagePost, true);
    xmlhttp.send();
    console.log("Request Sended");
    console.log("hola");
}