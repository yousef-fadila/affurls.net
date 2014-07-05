<?php 
/*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
* 
*
* Author: Yousef Fadila 
* Date: Feb 2010
*
*/
  include('_post.php');
	
?>


<?php if(logged_in()): ?>

<p>
  [ <a href="<?php echo '/'.APP_ROOT.'/'; ?>posts/<?php echo $post['id'] ?>/edit">edit</a> ]
	[ <a href="<?php echo '/'.APP_ROOT.'/'; ?>posts/<?php echo $post['id'] ?>/delete">delete</a> ]
<p>

<?php endif; ?>
