function initAjax()
{
	if(window.XMLHttpRequest)
	{
		request = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		request = new ActiveXObject("Msxml2.XMLHTTP");
		if(!request)
		{
			request = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return request;
}

function newTopic()
{
	var div = $('button');
	div.innerHTML = '<span style="margin-left:350px;">正在发送请求...</span>';
	var request = initAjax();
	request.onreadystatechange=handleReponse('/manage.html');
	var method = $F('method');
	var title = $F('title');
	var tags = $F('tags');
	var content = $F('content');

	var url = 'http://www.n7money.cn/post.php';
	var data = 'method=' + method + '&title=' + title + '&tags=' + tags + '&content=' + content;
	//alert(data);

	request.open('POST', url, true);
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	request.send(data);

}

function handleReponse(url)
{
	if(request.readyState == 4)
	{
		if(request.status == 200)
		{
			alert(request.responseText);
			if(request.responseText == 'ok')
			{
				window.location.href = url;
				var div = $('pro');
				div.innerHTML = '<span style="margin-left:350px;">发布成功...</span>';
			}
		}
		else
		{
			alert("Failure!");
		}
	}
}

function remove(id)
{
	if(confirm('确定要删除吗?'))
	{
		location.href = "http://www.n7money.cn/remove/" + id + ".html";
	}
}

function valid(element)
{
	var vaild = '&nbsp;<img src="/themes/X/images/tick.png" class="r" />';
	var invaild = '&nbsp;<img src="/themes/X/images/cross.png" class="r" />';
	var obj = $(element);
	if(!obj.value)
	{
		obj.morph('border-color:#f00; border-width:1px;');
		switch(element)
		{
			case 'title':
        	$('mesTitle').innerHTML = invaild;
				break;

			case 'tags':
        	$('mesTags').innerHTML = invaild;
				break;

			case 'content':
        	$('mesContent').innerHTML = invaild;
				break;

			default:;
		}
	}
	else
	{
		obj.morph('border-color:#3c0; border-width:1px;');
		switch(element)
		{
			case 'title':
        	$('mesTitle').innerHTML = vaild;
				break;

			case 'tags':
        	$('mesTags').innerHTML = vaild;
				break;

			case 'content':
        	$('mesContent').innerHTML = vaild;
				break;

			default:;
		}
	}
}

function send()
{
	var div = $('button');
	div.innerHTML = '<span style="margin-left:350px;">正在发送请求...</span>';
}
