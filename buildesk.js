$(document).ready(function () {
    var postData = {
        FirstName: '',
        Mobile: '',
        Email: '',
        Remark: '',
        Platform: "IMS-Ads",
        CampaignUID: "C020A449-5F87-4FB4-95CB-C30E57D2681C",
        ProjectUID: "4a280216-8aee-453a-947c-3e54778449e1",
        CampaignChannelUID: "44",
        CampaignChannel: "IMS-Website"
    };
    var thankyouurl = "https://divine.aashrithaa.com/thankyou.html"
    $("#popup-form").submit(function (event) {
        event.preventDefault();
        var values = {};
        $.each($(event.currentTarget).serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        postData.FirstName = values.name;
        postData.Mobile = values.mobile;
        postData.Email = values.email;
        postData.Remark = values.comment;

        postHttp(postData);
        $("#popup-form")[0].reset();
    });
    $("#popup-form_price").submit(function (event) {
        event.preventDefault();
        var values = {};
        $.each($(event.currentTarget).serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        postData.FirstName = values.name;
        postData.Mobile = values.mobile;
        postData.Email = values.email;
        postData.Remark = values.comment;

        postHttp(postData);
        $("#popup-form_price")[0].reset();
      //  var pdfUrl = "https://divine.aashrithaa.com/images/new/Divine Brochure.pdf";
      //  window.open(pdfUrl, "_blank");
    });
    $("#footer-form").submit(function (event) {
        event.preventDefault();
        var values = {};
        $.each($(event.currentTarget).serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        postData.FirstName = values.name;
        postData.Mobile = values.mobile;
        postData.Email = values.email;
        postData.Remark = values.comment;

        postHttp(postData);
        $("#footer-form")[0].reset();
    });

    function postHttp(input) {
        console.log(JSON.stringify(input));
        $.ajax({
            url: "https://buildeskapi.azurewebsites.net/api/CampaignWebhook",
            type: "POST", //send it through get method
            data: input,
            headers: {
                'Content-type': 'application/x-www-form-urlencoded', 
                'apikey' : 'ee6411f7-4da2-4172-b657-372a1151c93f'
            },
            success: function (response) {
                if(response.Success){
                    // window.location.href = thankyouurl;
                    emailService(input);
                }else{
                    emailService(input);
                    alert(response.Message);
                }
            },
            error: function (xhr) {
                console.log(JSON.stringify(xhr));
            }
        });

    };

    function emailService (leadData){
        $.ajax({
                type: 'POST',
                url: 'mail.php',
                data: leadData,
                success: function(data) {
                    console.log(data);
                    var resp=JSON.parse(data);
                    if(resp.result){
                        alert("Your message has been sent successfully. We will contact you shortly.");
                        window.location.href = thankyouurl;
                    }else{
                        alert('Something went wrong');
                    }
                }
        });
    }

});