<?php
class Elementor_List_Folders_Files_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'list_folders_files';
    }

    public function get_title() {
        return __('List Folders & Files', 'list-folders-files');
    }

    public function get_icon() {
        return 'eicon-folder-o';
    }

    public function get_categories() {
        return ['general'];
    }
      protected function register_controls() {
          // Content Tab
          $this->start_controls_section(
              'content_section',
              [
                  'label' => __('Content', 'list-folders-files'),
                  'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
              ]
          );

          $this->add_control(
              'path',
              [
                  'label' => __('Path', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::TEXT,
                  'default' => '',
                  'placeholder' => __('Enter path after wp-content/uploads/', 'list-folders-files'),
                  'description' => __('Enter path after wp-content/uploads/', 'list-folders-files'),
              ]
          );
            $this->add_control(
                'show_folders',
                [
                    'label' => __('Show Folders', 'list-folders-files'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'list-folders-files'),
                    'label_off' => __('No', 'list-folders-files'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'folder_depth',
                [
                    'label' => __('Folder Depth', 'list-folders-files'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 3,
                    'description' => __('Set the maximum depth of subfolders to display. Default is 3.', 'list-folders-files'),
                    'condition' => [
                        'show_folders' => 'yes',
                    ],
                ]
            );
          $this->add_control(
              'show_extensions',
              [
                  'label' => __('Show File Extensions', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::SWITCHER,
                  'label_on' => __('Yes', 'list-folders-files'),
                  'label_off' => __('No', 'list-folders-files'),
                  'return_value' => 'yes',
                  'default' => 'yes',
              ]
          );

          $this->add_control(
              'allowed_extensions',
              [
                  'label' => __('Allowed File Extensions', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::TEXT,
                  'default' => '',
                  'placeholder' => __('e.g. jpg,png,pdf', 'list-folders-files'),
                  'description' => __('Enter comma-separated file extensions to show. Leave empty to show all files.', 'list-folders-files'),
              ]
          );

          $this->end_controls_section();

          // Style Tab
          $this->start_controls_section(
              'style_section',
              [
                  'label' => __('Icons', 'list-folders-files'),
                  'tab' => \Elementor\Controls_Manager::TAB_STYLE,
              ]
          );

          $this->add_control(
              'icon_size',
              [
                  'label' => __('Icon Size', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::SLIDER,
                  'size_units' => ['px'],
                  'range' => [
                      'px' => [
                          'min' => 10,
                          'max' => 100,
                          'step' => 1,
                      ],
                  ],
                  'default' => [
                      'unit' => 'px',
                      'size' => 16,
                  ],
              ]
          );

          $this->add_control(
              'folder_icon_color',
              [
                  'label' => __('Folder Icon Color', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::COLOR,
                  'selectors' => [
                      '{{WRAPPER}} .lff-folder summary .lff-icon-span i' => 'color: {{VALUE}};',
                  ],
              ]
          );

          $this->add_control(
              'file_icon_color',
              [
                  'label' => __('File Icon Color', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::COLOR,
                  'selectors' => [
                      '{{WRAPPER}} .lff-file .lff-icon-span i' => 'color: {{VALUE}};',
                  ],
              ]
          );

          $this->end_controls_section();

          // Folders Container Style Section
          $this->start_controls_section(
              'folders_container_style_section',
              [
                  'label' => __('Folders Container', 'list-folders-files'),
                  'tab' => \Elementor\Controls_Manager::TAB_STYLE,
              ]
          );

          $this->add_control(
              'folders_container_background_color',
              [
                  'label' => __('Background Color', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::COLOR,
                  'selectors' => [
                      '{{WRAPPER}} .lff-folder-content' => 'background-color: {{VALUE}};',
                  ],
              ]
          );

          $this->add_responsive_control(
              'folders_container_margin',
              [
                  'label' => __('Margin', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::DIMENSIONS,
                  'size_units' => ['px', '%', 'em'],
                  'selectors' => [
                      '{{WRAPPER}} .lff-folder-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                  ],
              ]
          );

          $this->add_responsive_control(
              'folders_container_padding',
              [
                  'label' => __('Padding', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::DIMENSIONS,
                  'size_units' => ['px', '%', 'em'],
                  'selectors' => [
                      '{{WRAPPER}} .lff-folder-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                  ],
              ]
          );

          $this->add_group_control(
              \Elementor\Group_Control_Border::get_type(),
              [
                  'name' => 'folders_container_border',
                  'label' => __('Border', 'list-folders-files'),
                  'selector' => '{{WRAPPER}} .lff-folder-content',
              ]
          );

          $this->add_responsive_control(
              'folders_container_border_radius',
              [
                  'label' => __('Border Radius', 'list-folders-files'),
                  'type' => \Elementor\Controls_Manager::DIMENSIONS,
                  'size_units' => ['px', '%'],
                  'selectors' => [
                      '{{WRAPPER}} .lff-folder-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                  ],
              ]
          );

          $this->add_group_control(
              \Elementor\Group_Control_Box_Shadow::get_type(),
              [
                  'name' => 'folders_container_box_shadow',
                  'label' => __('Box Shadow', 'list-folders-files'),
                  'selector' => '{{WRAPPER}} .lff-folder-content',
              ]
          );

          $this->end_controls_section();

            // Folders Style Section
            $this->start_controls_section(
                'folders_style_section',
                [
                    'label' => __('Folders', 'list-folders-files'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

              $this->add_control(
                  'folder_text_color',
                  [
                      'label' => __('Folder Text Color', 'list-folders-files'),
                      'type' => \Elementor\Controls_Manager::COLOR,
                      'selectors' => [
                          '{{WRAPPER}} .lff-folder summary' => 'color: {{VALUE}};',
                      ],
                  ]
              );

              // Existing folder background color control
              $this->add_control(
                  'folder_summary_background_color',
                  [
                      'label' => __('Folder Background Color', 'list-folders-files'),
                      'type' => \Elementor\Controls_Manager::COLOR,
                      'selectors' => [
                          '{{WRAPPER}} .lff-folder-summary' => 'background-color: {{VALUE}};',
                      ],
                  ]
              );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'folder_typography',
                    'label' => __('Folder Typography', 'list-folders-files'),
                    'selector' => '{{WRAPPER}} .lff-folder summary',
                ]
            );
              $this->add_group_control(
                  \Elementor\Group_Control_Text_Shadow::get_type(),
                  [
                      'name' => 'folder_text_shadow',
                      'label' => __('Text Shadow', 'list-folders-files'),
                      'selector' => '{{WRAPPER}} .lff-folder summary',
                  ]
              );

              $this->add_responsive_control(
                  'folder_summary_margin',
                  [
                      'label' => __('Margin', 'list-folders-files'),
                      'type' => \Elementor\Controls_Manager::DIMENSIONS,
                      'size_units' => ['px', '%', 'em'],
                      'selectors' => [
                          '{{WRAPPER}} .lff-folder-summary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                      ],
                  ]
              );

              $this->add_responsive_control(
                  'folder_summary_padding',
                  [
                      'label' => __('Padding', 'list-folders-files'),
                      'type' => \Elementor\Controls_Manager::DIMENSIONS,
                      'size_units' => ['px', '%', 'em'],
                      'selectors' => [
                          '{{WRAPPER}} .lff-folder-summary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                      ],
                  ]
              );

              $this->add_group_control(
                  \Elementor\Group_Control_Border::get_type(),
                  [
                      'name' => 'folder_summary_border',
                      'label' => __('Border', 'list-folders-files'),
                      'selector' => '{{WRAPPER}} .lff-folder-summary',
                  ]
              );

              $this->add_responsive_control(
                  'folder_summary_border_radius',
                  [
                      'label' => __('Border Radius', 'list-folders-files'),
                      'type' => \Elementor\Controls_Manager::DIMENSIONS,
                      'size_units' => ['px', '%'],
                      'selectors' => [
                            '{{WRAPPER}} .lff-folder-summary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                      ],
                  ]
              );

              $this->add_group_control(
                  \Elementor\Group_Control_Box_Shadow::get_type(),
                  [
                      'name' => 'folder_summary_box_shadow',
                      'label' => __('Box Shadow', 'list-folders-files'),
                      'selector' => '{{WRAPPER}} .lff-folder-summary',
                  ]
              );

              $this->end_controls_section();
              
            // Files Style Section
            $this->start_controls_section(
                'files_style_section',
                [
                    'label' => __('Files', 'list-folders-files'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'file_text_color',
                [
                    'label' => __('File Text Color', 'list-folders-files'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lff-file-link' => 'color: {{VALUE}};',
                    ],
                ]
            );
              
            $this->add_control(
                'file_background_color',
                [
                    'label' => __('File Background Color', 'list-folders-files'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lff-file' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            
            // Existing file background color control
            $this->add_control(
                'file_background_color',
                [
                    'label' => __('File Background Color', 'list-folders-files'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lff-file' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'file_typography',
                    'label' => __('File Typography', 'list-folders-files'),
                    'selector' => '{{WRAPPER}} .lff-file-link',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'file_text_shadow',
                    'label' => __('Text Shadow', 'list-folders-files'),
                    'selector' => '{{WRAPPER}} .lff-file-link',
                ]
            );

            $this->add_responsive_control(
                'file_margin',
                [
                    'label' => __('Margin', 'list-folders-files'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .lff-file' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'file_padding',
                [
                    'label' => __('Padding', 'list-folders-files'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .lff-file' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'file_border',
                    'label' => __('Border', 'list-folders-files'),
                    'selector' => '{{WRAPPER}} .lff-file',
                ]
            );

            $this->add_responsive_control(
                'file_border_radius',
                [
                    'label' => __('Border Radius', 'list-folders-files'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .lff-file' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'file_box_shadow',
                    'label' => __('Box Shadow', 'list-folders-files'),
                    'selector' => '{{WRAPPER}} .lff-file',
                ]
            );

            $this->end_controls_section();
        } 

        // Render function
        protected function render() {
            $settings = $this->get_settings_for_display();
            $path = trailingslashit(wp_upload_dir()['basedir']) . $settings['path'];
            $icon_size = $settings['icon_size']['size'];
            $show_extensions = $settings['show_extensions'];
            $folder_depth = $settings['folder_depth'];
    
            if (!is_dir($path)) {
                echo __('Invalid path', 'list-folders-files');
                return;
            }
    
            // Include Font Awesome CDN
            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">';
    
            echo '<style>
            .lff-file-link {
                text-decoration: none;
            }
            .lff-folder { cursor: pointer; }
            .lff-folder summary { 
                list-style: none; 
                display: flex;
                align-items: center;
            }
            .lff-folder summary::-webkit-details-marker { display: none; }
            .lff-icon-span {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                width: ' . $icon_size . 'px;
                height: ' . $icon_size . 'px;
                margin-right: 5px;
            }
            .lff-icon-span i {
                font-size: ' . $icon_size . 'px;
                max-width: 100%;
                max-height: 100%;
            }
            .lff-folder-content {
                padding-left: ' . $icon_size . 'px;
            }
            .lff-file {
                display: flex;
                align-items: center;
                min-height: ' . $icon_size . 'px;
            }
        </style>';
            $this->list_folders_files($path, $settings['show_folders'], $settings['allowed_extensions'], $show_extensions, 0, $folder_depth);
        }

    private function list_folders_files($path, $show_folders, $allowed_extensions, $show_extensions, $current_depth = 0, $max_depth = 3) {
        $items = scandir($path);
        $folders = [];
        $files = [];

        $allowed_extensions_array = $allowed_extensions ? array_map('trim', explode(',', strtolower($allowed_extensions))) : [];

        foreach ($items as $item) {
            if ($item == '.' || $item == '..') continue;
            
            $full_path = $path . '/' . $item;
            if (is_dir($full_path)) {
                $folders[] = $item;
            } else {
                $extension = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                if (empty($allowed_extensions_array) || in_array($extension, $allowed_extensions_array)) {
                    $files[] = $item;
                }
            }
        }

        sort($folders);
        sort($files);

        if ($show_folders === 'yes' && $current_depth < $max_depth) {
            foreach ($folders as $folder) {
                $full_path = $path . '/' . $folder;
                echo str_repeat('  ', $current_depth);
                echo "<details class='lff-folder'>\n";
                echo str_repeat('  ', $current_depth + 1);
                echo "<summary class='lff-folder-summary'><span class='lff-icon-span'><i class='fas fa-folder'></i></span>$folder</summary>\n";
                echo "<div class='lff-folder-content'>\n";
                $this->list_folders_files($full_path, $show_folders, $allowed_extensions, $show_extensions, $current_depth + 1, $max_depth);
                echo "</div>\n";
                echo str_repeat('  ', $current_depth);
                echo "</details>\n";
            }
        }

        foreach ($files as $file) {
            $file_url = str_replace(wp_upload_dir()['basedir'], wp_upload_dir()['baseurl'], $path . '/' . $file);
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $file_icon = $this->get_file_icon($extension);
            $display_name = $show_extensions === 'yes' ? $file : pathinfo($file, PATHINFO_FILENAME);
            
            echo str_repeat('  ', $current_depth);
            echo "<div class='lff-file'>";
            echo "<span class='lff-icon-span'><i class='{$file_icon}'></i></span>";
            echo "<a href='$file_url' class='lff-file-link' target='_blank'>{$display_name}</a>";
            echo "</div>\n";
        }
    }

    private function get_file_icon($extension) {
        $icon_map = [
            'pdf' => 'fas fa-file-pdf',
            'doc' => 'fas fa-file-word',
            'docx' => 'fas fa-file-word',
            'xls' => 'fas fa-file-excel',
            'xlsx' => 'fas fa-file-excel',
            'ppt' => 'fas fa-file-powerpoint',
            'pptx' => 'fas fa-file-powerpoint',
            'jpg' => 'fas fa-file-image',
            'jpeg' => 'fas fa-file-image',
            'png' => 'fas fa-file-image',
            'gif' => 'fas fa-file-image',
            'txt' => 'fas fa-file-alt',
            // Add more file types as needed
        ];

        return isset($icon_map[$extension]) ? $icon_map[$extension] : 'fas fa-file';
    }
}