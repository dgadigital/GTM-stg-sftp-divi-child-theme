jQuery(document).ready(function ($) {
  // Run only on default page templates
  if (!$('body').hasClass('page-template-default')) return;

  const data = [];

  $('.et_pb_button').each(function () {
    const $btn = $(this);
    const bgColor = $btn.css('background-color');
    const textColor = $btn.css('color');

    // Find the closest Divi section
    const $section = $btn.closest('.et_pb_section');
    let sectionBgColor = $section.css('background-color');
    let sectionBgImage = $section.css('background-image');

    // If section has no background color but has an image
    if (
      (!sectionBgColor || sectionBgColor === 'rgba(0, 0, 0, 0)' || sectionBgColor === 'transparent') &&
      sectionBgImage &&
      sectionBgImage !== 'none'
    ) {
      sectionBgColor = '(has background image)';
    }

    data.push({
      Button: $btn.text().trim() || '(no text)',
      'Button BG': bgColor,
      'Button Text Color': textColor,
      'Section BG': sectionBgColor,
      'Section BG Image': sectionBgImage !== 'none' ? sectionBgImage : '(none)',
    });
  });

  console.table(data);
});
