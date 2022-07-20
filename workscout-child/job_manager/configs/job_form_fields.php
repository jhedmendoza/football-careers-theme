<?php

$fields['job']['country'] = array(
  'label'       => __( 'Country', 'job_manager' ),
  'type'        => 'text',
  'required'    => true,
  'placeholder' => '',
  'priority'    => 3
);

$fields['job']['career_experience'] = array(
  'label'       => __( 'Career Level', 'job_manager' ),
  'type'        => 'text',
  'placeholder' => 'Example: Head Coach',
  'priority'    => 13
);

$fields['job']['career_level'] = array(
  'label'       => __( 'Experience', 'job_manager' ),
  'type'        => 'text',
  'placeholder' => 'Example: 20yrs',
  'priority'    => 14
);

$fields['job']['job_start_date'] = array(
  'label'       => __( 'Start Date', 'job_manager' ),
  'type'        => 'date',
  'priority'    => 15
);

$fields['job']['career_qualifications'] = array(
  'label'       => __( 'Qualifications', 'job_manager' ),
  'type'        => 'text',
  'placeholder' => 'Example: Pro License',
  'priority'    => 16
);

/*****************************************************************/

$fields['job']['about_our_club'] = array(
  'label'       => __( 'About Our Club', 'job_manager' ),
  'type'        => 'textarea',
  'description' => 'Separate values by new line.',
  'priority'    => 18
);

$fields['job']['the_position'] = array(
  'label'       => __( 'The Position', 'job_manager' ),
  'type'        => 'textarea',
  'description' => 'Separate values by new line.',
  'priority'    => 19
);

$fields['job']['the_job_details'] = array(
  'label'       => __( 'Job Details', 'job_manager' ),
  'type'        => 'textarea',
  'description' => 'Separate values by new line.',
  'priority'    => 20
);

$fields['job']['job_requirements'] = array(
  'label'       => __( 'Requirements', 'job_manager' ),
  'type'        => 'textarea',
  'description' => 'Separate values by new line.',
  'priority'    => 21
);


/*****************************************************************/



// $fields['job']['postal_code'] = array(
//   'label'       => __( 'Postal Code', 'job_manager' ),
//   'type'        => 'text',
//   'priority'    => 20
// );

// $fields['job']['full_address'] = array(
//   'label'       => __( 'Full Address', 'job_manager' ),
//   'type'        => 'text',
//   'placeholder' => '',
//   'priority'    => 21
// );

// $fields['job']['latitude'] = array(
//   'label'       => __( 'Latitude', 'job_manager' ),
//   'type'        => 'text',
//   'placeholder' => '',
//   'priority'    => 22
// );

// $fields['job']['longtitude'] = array(
//   'label'       => __( 'Longtitude', 'job_manager' ),
//   'type'        => 'text',
//   'placeholder' => '',
//   'priority'    => 23
// );

// $fields['job']['zoom'] = array(
//   'label'       => __( 'Zoom', 'job_manager' ),
//   'type'        => 'text',
//   'placeholder' => '',
//   'priority'    => 24
// );


return $fields;