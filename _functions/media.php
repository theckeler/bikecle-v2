<?
/**
 * Adding our custom fields to the $form_fields array
 * 
 * @param array $form_fields
 * @param object $post
 * @return array
 */
function my_image_attachment_fields_to_edit($form_fields, $post) {
    $form_fields["custom1"]["label"] = __("Image ID");
    $form_fields["custom1"]["input"] = "html";
    $form_fields["custom1"]["html"] = "<input type='text' class='text urlfield' readonly='readonly' value='" . $post->ID . "' /><br />";
     
    return $form_fields;
}
add_filter("attachment_fields_to_edit", "my_image_attachment_fields_to_edit", null, 2);
?>