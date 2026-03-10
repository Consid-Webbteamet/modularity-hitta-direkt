<?php

declare(strict_types=1);

namespace ModularityHittaDirekt\Module;

class HittaDirekt extends \Modularity\Module
{
    public $slug = "hitta-direkt";
    public $supports = [];
    public $isBlockCompatible = true;
    public $expectsTitleField = false;

    public function init(): void
    {
        $this->nameSingular = __("Hitta direkt", "modularity-hitta-direkt");
        $this->namePlural = __("Hitta direkt", "modularity-hitta-direkt");
        $this->description = __(
            "Visar klickbara ikonlänkar i en rad.",
            "modularity-hitta-direkt",
        );
    }

    public function data(): array
    {
        $fields = $this->getFields();
        $items = $this->normalizeItems((array) ($fields["items"] ?? []));

        return [
            "items" => $items,
        ];
    }

    public function template(): string
    {
        return "hitta-direkt.blade.php";
    }

    /**
     * @param array<int, mixed> $items
     * @return array<int, array{icon:string,colorKey:string,colorValue:string,label:string,link:array{url:string,title:string,target:string}}>
     */
    private function normalizeItems(array $items): array
    {
        $normalized = [];

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $link = $this->normalizeLink($item["link"] ?? []);
            $icon = trim((string) ($item["icon"] ?? ""));

            if ($link["url"] === "" || $icon === "") {
                continue;
            }

            $colorKey = (string) ($item["color"] ?? "blue");
            $normalized[] = [
                "icon" => $icon,
                "colorKey" => $colorKey,
                "colorValue" => $this->getColorValue($colorKey),
                "label" => $link["title"],
                "link" => $link,
            ];
        }

        return array_slice($normalized, 0, 5);
    }

    /**
     * @param mixed $link
     * @return array{url:string,title:string,target:string}
     */
    private function normalizeLink($link): array
    {
        if (!is_array($link)) {
            return [
                "url" => "",
                "title" => "",
                "target" => "",
            ];
        }

        return [
            "url" => (string) ($link["url"] ?? ""),
            "title" => wp_specialchars_decode(
                (string) ($link["title"] ?? ""),
                ENT_QUOTES,
            ),
            "target" => (string) ($link["target"] ?? ""),
        ];
    }

    private function getColorValue(string $colorKey): string
    {
        $colorMap = [
            "blue" => "var(--color-primary-500)",
            "red" => "var(--color-secondary-500)",
            "green" => "var(--color-quaternary-500)",
            "orange" => "#A86700",
            "purple" => "#6F2A67",
        ];

        return $colorMap[$colorKey] ?? $colorMap["blue"];
    }
}
