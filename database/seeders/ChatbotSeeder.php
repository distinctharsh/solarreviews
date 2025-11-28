<?php

namespace Database\Seeders;

use App\Models\ChatbotOption;
use App\Models\ChatbotQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatbotSeeder extends Seeder
{
    public function run(): void
    {
        if (ChatbotQuestion::query()->exists()) {
            return;
        }

        DB::transaction(function () {
            $intro = ChatbotQuestion::create([
                'title' => 'Welcome Prompt',
                'prompt' => 'Hi! I am the Solar Reviews assistant. What would you like help with today?',
                'type' => 'choice',
                'is_required' => true,
                'display_order' => 1,
            ]);

            $stateQuestion = ChatbotQuestion::create([
                'title' => 'State Selection',
                'prompt' => 'Great! Which state are you located in?',
                'type' => 'input',
                'input_placeholder' => 'e.g. Maharashtra',
                'is_required' => true,
                'display_order' => 2,
            ]);

            $detailsQuestion = ChatbotQuestion::create([
                'title' => 'Issue Details',
                'prompt' => 'Please describe your requirement or issue in a sentence or two.',
                'type' => 'text',
                'input_placeholder' => 'Tell us about your solar project or problem',
                'display_order' => 3,
            ]);

            $thanksQuestion = ChatbotQuestion::create([
                'title' => 'Thank You',
                'prompt' => 'Thank you! Our team will review your message and get back with the best installers or advice.',
                'type' => 'choice',
                'is_required' => false,
                'display_order' => 4,
            ]);

            $intro->update(['default_next_question_id' => $stateQuestion->id]);
            $stateQuestion->update(['default_next_question_id' => $detailsQuestion->id]);
            $detailsQuestion->update(['default_next_question_id' => $thanksQuestion->id]);

            ChatbotOption::insert([
                [
                    'question_id' => $intro->id,
                    'label' => 'Find top installers in my area',
                    'value' => 'installer_help',
                    'description' => 'Compare verified EPC and installer companies',
                    'display_order' => 1,
                    'next_question_id' => $stateQuestion->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'question_id' => $intro->id,
                    'label' => 'Report an issue with my current solar setup',
                    'value' => 'troubleshoot_system',
                    'description' => 'Panels, inverter, battery, or monitoring issue',
                    'display_order' => 2,
                    'next_question_id' => $stateQuestion->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'question_id' => $intro->id,
                    'label' => 'Get advice on solar products or financing',
                    'value' => 'product_advice',
                    'description' => 'Panels, inverters, warranties, or loan info',
                    'display_order' => 3,
                    'next_question_id' => $stateQuestion->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'question_id' => $thanksQuestion->id,
                    'label' => 'Submit another query',
                    'value' => 'another_query',
                    'description' => 'Restart the assistant flow',
                    'display_order' => 1,
                    'next_question_id' => $intro->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        });
    }
}
