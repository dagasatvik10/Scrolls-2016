$(document).ready(function() {
  // get request to fetch courses and append to form select
  $.get("http://akgec-scrolls.com/rest/api/Domains/GetCourses", function(data,status) {
    //console.log(data.length);
    $.each(data, function (i, item) {
      $('#form-course').append($('<option>', {
        value: item.CourseId,
        text : item.CourseName
      }));
    });
  });

  // get request to fetch Colleges and append to form select
  $.get("http://akgec-scrolls.com/rest/api/Colleges/GetColleges", function(data,status) {
    //console.log(data.length);
    $.each(data, function (i, item) {
      if (item.CollegeId!=4) {
        $('#form-college').append($('<option>', {
          value: item.CollegeId,
          text : item.CollegeName
        }));
      }
    });

    $('#form-college').append($('<option>', {
      value: "",
      text : "OTHERS"
    }));
  });

  // get request to fetch domains and append to form select
  $.get("http://akgec-scrolls.com/rest/api/Domains/GetDomains", function(data,status) {
    //console.log(data.length);
    $.each(data, function (i, item) {
      $('#form-domains').append($('<option>', {
        value: item.DomainId,
        text : item.DomainName
      }));
    });
  });

  // get request to fetch topics for domain and append to form select
  $.get("http://akgec-scrolls.com/rest/api/Domains/GetTopics?domainId=6", function(data,status) {
    //console.log(data.length);
    $.each(data, function (i, item) {
      $('#form-topics').append($('<option>', {
        value: item.TopicId,
        text : item.TopicName
      }));
    });
  });

  // $('#form-domains').change(function() {
  //   var id = $(this).val();
  //
  //   $.get("http://akgec-scrolls.com/rest/api/Domains/GetTopics?domainId="+id, function(data,status) {
  //     //console.log(data.length);
  //     $.each(data, function (i, item) {
  //       $('#form-topics').append($('<option>', {
  //         value: item.TopicId,
  //         text : item.TopicName
  //       }));
  //     });
  //   });
  // });
});
