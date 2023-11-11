<?php
namespace Elementor;

use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Video_Widget extends Widget_Base {

    public function get_name() {
        return 'video-addon';
    }

    public function get_title() {
        return __('Video Widget', 'video-addon-pro');
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_categories() {
        return ['akira'];
    }

    protected function register_controls() {
        // Add widget controls here
        $this->start_controls_section(
            'video_section',
            [
                'label' => __('Video Settings', 'video-addon-pro'),
            ]
        );

        $this->add_control(
            'video_url',
            [
                'label' => esc_html__( 'Choose Video File', 'video-addon-pro' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_types' => [
                    'video',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $video_url = $settings['video_url'];
        if (!empty($video_url['url'])) {
            ?>
            <div class="video-grid">
                <div class="video">
                    <video class="video-thumbnail" src="<?php echo esc_url($video_url['url']);?>" loop muted></video>
                    <img class="thumbnail" src="" alt="Video Thumbnail">
                    <div class="play-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                            <path d="M11.208 8.002l-4.045 3.212A1 1 0 0 1 6 10V6a1 1 0 0 1 1.163-.99l4.045 3.212a1 1 0 0 1 0 1.576z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="popup">
                <div class="popup-content">
                    <video class="popup-video" controls></video>
                    <div class="close-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M8 7.293L4.354 3.646a.5.5 0 0 1 .708-.708L8 6.293l3.646-3.647a.5.5 0 0 1 .708.708L8 7.293l3.646 3.647a.5.5 0 0 1-.708.708L8 8.707l-3.646 3.647a.5.5 0 0 1-.708-.708L7.293 8 3.647 4.354a.5.5 0 0 1 .708-.708L8 7.293z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register(new Video_Widget());