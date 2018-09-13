<?php
/*
 * This code is licensed under the MIT License.
 *
 * Copyright (c) 2018 appwilio <appwilio.com>
 * Copyright (c) 2018 JhaoDa <jhaoda@gmail.com>
 * Copyright (c) 2018 greabock <greabock17@gmail.com>
 * Copyright (c) 2018 Alexey Kopytko <alexey@kopytko.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

declare(strict_types=1);

namespace Appwilio\CdekSDK\Requests;

use Appwilio\CdekSDK\Common\ChangePeriod;
use Appwilio\CdekSDK\Common\Order;
use Appwilio\CdekSDK\Contracts\ShouldAuthorize;
use Appwilio\CdekSDK\Contracts\XmlRequest;
use Appwilio\CdekSDK\Requests\Concerns\Authorized;
use Appwilio\CdekSDK\Requests\Concerns\OrdersAware;
use Appwilio\CdekSDK\Requests\Concerns\RequestCore;
use Appwilio\CdekSDK\Responses\InfoReportResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class InfoReportRequest.
 *
 * @JMS\XmlRoot(name="InfoRequest")
 */
final class InfoReportRequest implements XmlRequest, ShouldAuthorize
{
    use Authorized, OrdersAware, RequestCore;

    const METHOD = 'POST';
    const ADDRESS = '/info_report.php';
    const RESPONSE = InfoReportResponse::class;

    /**
     * @JMS\SerializedName("ChangePeriod")
     * @JMS\Type("string")
     *
     * @var ChangePeriod|null
     */
    protected $ChangePeriod;

    public function addOrder(Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    public function setChangePeriod(ChangePeriod $period)
    {
        $this->ChangePeriod = $period;

        return $this;
    }
}
