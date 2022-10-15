// $(document).ready(function() {
//   $('#example').bootstrapTable();

//     $('#delete-posts').unbind();
//     $('#delete-posts').click(function() {
//       let idTitle = $(this).data('idTitle');

//         const swalWithBootstrapButtons = Swal.mixin({
//           customClass: {
//             confirmButton: 'btn btn-success',
//             cancelButton: 'btn btn-danger'
//           },
//           buttonsStyling: false
//         })
//         swalWithBootstrapButtons.fire({
//           title: 'Are you sure?',
//           text: "Do you want to delete!" + idTitle + "?",
//           icon: 'warning',
//           showCancelButton: true,
//           confirmButtonText: 'Yes, delete it!',
//           cancelButtonText: 'No, cancel!',
//           reverseButtons: true
//         }).then((result) => {
//           if (result.isConfirmed) {
//           $.ajax({
//           url: path('deleteTitles'),
//           type: 'post',
//           data: {
//             idTitle: idTitle,
//           }
//           }).done(function(response){
//             if(response.sucess == true){
//               $('#example').bootstrapTable('removeAll');
//               $('#example').bootstrapTable('refresh');
//               swalWithBootstrapButtons.fire(
//                 'Deleted!',
//                 'Your file has been deleted.',
//                 'success'
//               )
//             } else if (
//               /* Read more about handling dismissals below */
//               result.dismiss === Swal.DismissReason.cancel
//             ) {
//               swalWithBootstrapButtons.fire(
//                 'Cancelled',
//                 'Your imaginary file is safe :)',
//                 'error'
//               )
//             }
//             })
//         }});
//       })
//     });
