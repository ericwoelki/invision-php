<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-type NotificationData array{notificationType: string, notificationApp: string, itemClass: string, itemId: int,
 *  subItemClass: string, subItemId: int, item: array<mixed>|null, itemSub: array<mixed>|null,
 *  sentDate: string, updatedDate: string, readDate: string|null, notificationData: array<mixed>}
 */
final readonly class Notification
{
    /**
     * @param  array<mixed>|null  $item
     * @param  array<mixed>|null  $subItem
     * @param  array<mixed>  $data
     */
    public function __construct(
        public string $type,
        public string $application,
        public string $class,
        public int $itemId,
        public ?string $subItemClass,
        public ?int $subItemId,
        public ?array $item,
        public ?array $subItem,
        public CarbonImmutable $sentDate,
        public CarbonImmutable $updatedDate,
        public ?CarbonImmutable $readDate,
        public array $data,
    ) {}

    /** @param NotificationData $data */
    public static function fromArray(array $data): Notification
    {
        return new self(
            type: $data['notificationType'],
            application: $data['notificationApp'],
            class: $data['itemClass'],
            itemId: $data['itemId'],
            subItemClass: $data['subItemClass'],
            subItemId: $data['subItemId'],
            item: $data['item'],
            subItem: $data['itemSub'],
            sentDate: CarbonImmutable::parse($data['sentDate']),
            updatedDate: CarbonImmutable::parse($data['updatedDate']),
            readDate: $data['readDate'] !== null ? CarbonImmutable::parse($data['readDate']) : null,
            data: $data['notificationData'],
        );
    }
}
