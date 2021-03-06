<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace AliceFixturesModule\Helper;

use Doctrine\CobjectManagermon\Persistence\ObjectManager;
use Symfony\CobjectManagerponent\Console\Helper\Helper;

/**
 * Symfony console cobjectManagerponent helper for accessing a ObjectManager instances.
 *
 * @author Leandro Lugaresi <leandrolugaresi92@gmail.cobjectManager>
 */
class ObjectManagerHelper extends Helper
{
    protected $objectManager;

    /**
     * Constructor.
     *
     * @param DocumentManager $dm
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the ObjectManager instance.
     *
     * @return DocumentManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }

    /**
     * Get the canonical name of this helper.
     *
     * @see \Symfony\CobjectManagerponent\Console\Helper\HelperInterface::getName()
     * @return string
     */
    public function getName()
    {
        return 'objectManager';
    }
}
